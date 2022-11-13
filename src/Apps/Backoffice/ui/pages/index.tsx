import { useState } from 'react';
import Head from 'next/head';
import Image from 'next/image';

import { Container, IconButton } from '@mui/material';

import DocumentList from '../components/Document/List';

import styles from '../styles/Home.module.css';
import DocumentEditor from '../components/Document/Editor';
import DocumentCreateForm from '../components/Document/DocumentCreateForm';
import { Refresh, Close, Add } from '@mui/icons-material';

export default function Home() {
  const [documents, setDocuments] = useState([]);
  const [activeDocument, setActiveDocument] = useState(null);
  const [documentCreate, setDocumentCreate] = useState(false);

  const handleSubmit = async (event: { preventDefault: () => void; target: { title: { value: any }; content: { value: any } } }) => {
    event.preventDefault();
  
    const data = {
      title: event.target.title.value,
      content: event.target.content.value,
    }
  
    const JSONdata = JSON.stringify(data);
  
    const endpoint = '/api/document';
  
    const options = {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSONdata,
    }
  
    const response = await fetch(endpoint, options);
  
    await response.json();
    
    updateDocuments();
  }

  const handlePutSubmit = async (event: { 
    preventDefault: () => void; 
    target: { 
      slug: { value: any }; 
      title: { value: any }; 
      content: { value: any } 
    } 
  }) => {
    event.preventDefault();
    
    const data = {
      slug: event.target.slug.value,
      title: event.target.title.value,
      content: event.target.content.value,
    }

    const JSONdata = JSON.stringify(data);

    const endpoint = '/api/putDocument';

    const options = {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSONdata,
    }

    const response = await fetch(endpoint, options);

    await response.json();
    
    updateDocuments(); 
  }

  const updateDocuments = async () => {
    const endpoint = '/api/fetchAllDocuments';

    const options = {
      method: 'GET'
    };
  
    const response = await fetch(endpoint, options);
  
    const result = await response.json();

    setDocuments(result);
  }

  const showDocumentList = () => {
    setActiveDocument(null);
    setDocumentCreate(false);
  }

  const showDocumentCreate = () => {
    setActiveDocument(null);
    setDocumentCreate(true);
  }

  return (
    <div className={styles.container}>
      <Head>
        <title>Documents Backoffice</title>
        <link rel="icon" href="/favicon.ico" />
      </Head>

      <main className={styles.main}>
        <h1 className={styles.title}>
        Documents Backoffice
        </h1>
        <Container maxWidth='xl' style={{overflow: 'visible', marginInline: 'auto'}}>
          <div style={{display: 'flex', flexDirection: 'row', width: '100%'}}>
            <div className={`${styles.documentList} ${!activeDocument && !documentCreate && styles.active}`} style={{minWidth: '100%'}}>
              <div style={{display: 'flex', gap: '1rem', justifyContent: 'flex-end'}}>
                <IconButton onClick={showDocumentCreate}>
                  <Add />
                </IconButton>
                <IconButton onClick={updateDocuments}>
                  <Refresh />
                </IconButton>
              </div>
              {documents && <DocumentList documents={documents} activeDocument={activeDocument} setActiveDocument={setActiveDocument} />}
            </div>
            <div className={`${styles.documentEditor} ${(activeDocument || documentCreate) && styles.active}`} 
              style={{minWidth: '100%'}}
            >
              <div style={{display: 'flex', alignItems: 'flex-end'}}>
                <div style={{marginLeft: 'auto'}}>
                  <IconButton onClick={showDocumentList}>
                    <Close />
                  </IconButton>
                </div>
              </div>
              {documentCreate && <DocumentCreateForm handleSubmit={handleSubmit} />}
              {activeDocument && <DocumentEditor document={activeDocument} handleSubmit={handlePutSubmit} />}
            </div>
          </div>
        </Container>
      </main>

      <footer className={styles.footer}>
      <a
          href="https://es.linkedin.com/in/jos%C3%A9-el%C3%ADas-guti%C3%A9rrez-32114696"
          target="_blank"
          rel="noopener noreferrer"
        >
          Powered by{' '}
          <span className={styles.logo}>
          💩
          </span>
        </a>
      </footer>
    </div>
  )
}
