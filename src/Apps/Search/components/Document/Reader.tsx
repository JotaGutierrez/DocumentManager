import { TextField } from '@mui/material';
import { useEffect, useState } from 'react';
import DocumentInterface from '../../types/Document/Document';

interface props {
    document: DocumentInterface;
}

const DocumentReader = ({document}: props) => {
    const [_title, setTitle] = useState('');
    const [_content, setContent] = useState('')

    useEffect(() => {
        setTitle(document.title);
        setContent(document.content);
    }, [document]);

    return <div style={{display: 'flex', flexDirection: 'column', gap: '2rem'}}>
        <div>{_title}</div>
        <div dangerouslySetInnerHTML={{__html: _content}} />
    </div>
};

export default DocumentReader;
