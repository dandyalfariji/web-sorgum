import os
from fastapi import FastAPI, HTTPException
from fastapi.middleware.cors import CORSMiddleware
from pydantic import BaseModel
from dotenv import load_dotenv
from langchain_huggingface import HuggingFaceEmbeddings
from langchain_community.vectorstores import Chroma
from langchain_openai import ChatOpenAI
from langchain.chains import create_retrieval_chain
from langchain.chains.combine_documents import create_stuff_documents_chain
from langchain_core.prompts import ChatPromptTemplate

load_dotenv()

app = FastAPI(title="Sorgummi AI RAG Service")

app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

DB_DIR = os.path.abspath(os.path.join(os.path.dirname(__file__), '..', 'chroma_sorgum_db'))

# Initialize embeddings and DB
embeddings = HuggingFaceEmbeddings(model_name="all-MiniLM-L6-v2")
vectorstore = Chroma(persist_directory=DB_DIR, embedding_function=embeddings)
retriever = vectorstore.as_retriever(search_kwargs={"k": 3})

# Initialize LLM via 9Router
llm = ChatOpenAI(
    api_key=os.getenv("NINEROUTER_API_KEY", "dummy"),
    base_url=os.getenv("NINEROUTER_BASE_URL", "https://api.9router.com/v1"),
    model=os.getenv("NINEROUTER_MODEL", "deepseek/deepseek-chat"),
)

system_prompt = (
    "Kamu adalah Sorgummi, asisten AI cerdas dan ramah dari portal Sorgumology. "
    "Tugasmu adalah menjawab pertanyaan seputar sorgum, pertanian, dan topik terkait lainnya "
    "berdasarkan informasi berikut.\n\n"
    "Konteks:\n{context}\n\n"
    "Jika informasi tidak ada dalam konteks, jawablah menggunakan pengetahuan umum, tetapi "
    "prioritaskan konteks yang diberikan."
)

prompt = ChatPromptTemplate.from_messages([
    ("system", system_prompt),
    ("human", "{input}"),
])

question_answer_chain = create_stuff_documents_chain(llm, prompt)
rag_chain = create_retrieval_chain(retriever, question_answer_chain)

class ChatRequest(BaseModel):
    message: str

class ChatResponse(BaseModel):
    reply: str

@app.post("/chat", response_model=ChatResponse)
async def chat_endpoint(request: ChatRequest):
    try:
        response = rag_chain.invoke({"input": request.message})
        return ChatResponse(reply=response["answer"])
    except Exception as e:
        raise HTTPException(status_code=500, detail=str(e))

if __name__ == "__main__":
    import uvicorn
    uvicorn.run(app, host="0.0.0.0", port=8001)
