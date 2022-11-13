import * as React from 'react';

import { LocalLibrary } from '@mui/icons-material';
import { Card, CardActionArea, CardContent, CardHeader, IconButton } from '@mui/material';

import DocumentInterface from '../../types/Document/Document';

import styles from './Card.module.css';

interface props {
  document: DocumentInterface;
  setActiveDocument: Function;
  active: Boolean;
}

const DocumentCard = ({document, setActiveDocument, active}: props) =>
  <Card elevation={3} className={`${styles.document} ${active ? styles.active : ''}`} sx={{ minWidth: 275, minHeight: '182px' }} variant='outlined'>
    <CardHeader title={document.title} subheader={document.slug} />
    <CardContent style={{maxHeight: '6rem', minHeight: '6rem', overflow: 'hidden', textOverflow: 'ellipsis', wordWrap: 'break-word'}}>{document.content}</CardContent>
    <CardActionArea>
      <IconButton onClick={() => setActiveDocument(document)}>
        <LocalLibrary />
      </IconButton>
    </CardActionArea>
  </Card>
;

export default DocumentCard;
