import { Button, TextField } from "@mui/material";

interface props {
  handleSubmit: Function;
}

const DocumentCreateForm = ({handleSubmit}: props) => 
  <form
    autoComplete="off" 
    onSubmit={handleSubmit}
  >
    <div style={{display: 'flex', flexDirection: 'column', gap: '2rem'}}>
      <div>
        <TextField 
          type="text" 
          name="title"
          label="Title"
          fullWidth
        />
      </div>
      <div>
        <TextField 
          multiline 
          minRows={5} 
          name="content"
          label="Content"
          fullWidth 
        />
      </div>
      <div style={{textAlign: 'right'}}>
        <Button type="submit">Create</Button>
      </div>
    </div>
  </form>
;

export default DocumentCreateForm;
