import DocumentInterface from "../../types/Document/Document"
import DocumentCard from "./Card";

import styles from './List.module.css';

interface props {
    documents: Array<DocumentInterface>;
    activeDocument?: DocumentInterface;
    setActiveDocument: Function;
}

const DocumentList = ({documents, activeDocument, setActiveDocument}: props) =>
    <div className={styles.documentList}>
        {documents && documents.map((document: DocumentInterface, key: number) => 
            <DocumentCard 
                active={ document.slug === activeDocument?.slug } 
                document={document} 
                key={key} 
                setActiveDocument={setActiveDocument} 
                />
            )
        }
    </div>
;

export default DocumentList;