
export default async function handler(req, res) {
  const body = req.body;

  const response = await fetch('http://backendapp/document', {
    method: 'PUT',
    body: JSON.stringify(body),
    headers: {
      'Content-Type': 'application/json'
    }
  });

  const content = await response.json();
  console.log(content);
  res.status(200).json('ok');
}
