
export default async function handler(req, res) {
    const body = req.body;
  
    const response = await fetch('http://backendapp/documents', {
      method: 'GET'
    });
  
    const content = await response.json();
  
    res.status(200).json(content);
  }
  