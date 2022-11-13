import { Button, TextField } from '@mui/material';
import { FormEventHandler, SetStateAction, useEffect, useState } from 'react';
import DocumentInterface from '../../types/Document/Document';

interface props {
    document: DocumentInterface;
    handleSubmit: FormEventHandler<HTMLFormElement>;
}

const DocumentEditor = ({document, handleSubmit}: props) => {
    const [_title, setTitle] = useState(document.title);
    const [_content, setContent] = useState(document.content);

    const handleTitleChange = (event: { target: { value: SetStateAction<string>; }; }) => setTitle(event.target.value);
    const handleContent = (event: { target: { value: SetStateAction<string>; }; }) => setContent(event.target.value);

    useEffect(() => {
        setTitle(document.title);
        setContent(document.content);
    }, [document]);

    return <form method='PUT' onSubmit={handleSubmit} style={{display: 'flex', flexDirection: 'column', gap: '2rem'}}>
        <div>
            <TextField fullWidth name='title' label='Title' onChange={handleTitleChange} value={_title}/>
        </div>
        <div>
            <TextField disabled fullWidth name='slug' label='Slug' value={document.slug}/>
        </div>
        <div>
            <TextField
                fullWidth 
                multiline 
                minRows={25} 
                name="content"
                label="Content"
                onChange={handleContent}
                value={_content}
            />
        </div>
        <div style={{textAlign: 'right'}}>
            <Button type="submit">Update</Button>
        </div>
    </form>
};

export default DocumentEditor;
