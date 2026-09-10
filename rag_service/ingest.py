import os
from langchain_community.document_loaders import DirectoryLoader, TextLoader
from langchain.text_splitter import RecursiveCharacterTextSplitter
from langchain_huggingface import HuggingFaceEmbeddings
from langchain_community.vectorstores import Chroma

DOCS_DIR = os.path.abspath(os.path.join(os.path.dirname(__file__), '..', 'data_sorgum_docs'))
DB_DIR = os.path.abspath(os.path.join(os.path.dirname(__file__), '..', 'chroma_sorgum_db'))

def main():
    print(f"Loading documents from {DOCS_DIR}...")
    loader = DirectoryLoader(DOCS_DIR, glob="**/*.txt", loader_cls=TextLoader)
    documents = loader.load()
    
    if not documents:
        print("No documents found. Please add some .txt files to data_sorgum_docs/")
        return

    print(f"Loaded {len(documents)} documents.")
    
    # Split documents into chunks
    text_splitter = RecursiveCharacterTextSplitter(chunk_size=600, chunk_overlap=100)
    texts = text_splitter.split_documents(documents)
    print(f"Split into {len(texts)} chunks.")

    # Initialize embeddings
    embeddings = HuggingFaceEmbeddings(model_name="all-MiniLM-L6-v2")

    # Save to ChromaDB
    print(f"Saving to ChromaDB at {DB_DIR}...")
    vectorstore = Chroma.from_documents(documents=texts, embedding=embeddings, persist_directory=DB_DIR)
    
    print("Ingestion complete.")

if __name__ == "__main__":
    main()
