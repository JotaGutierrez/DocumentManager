
export default async function handler(req, res) {
  const body = req.body;

  const response = await fetch('http://backendapp/document', {
    method: 'POST',
    body: JSON.stringify(body),
    headers: {
      'Content-Type': 'application/json'
    }
  });

  const content = await response.json();

  res.status(200).json('ok');
}
