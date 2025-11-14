const { Router } = require('express');
const router = Router();

router.get('/usuarios', (request, response) => {
    console.log("llegue a usuarios");
    response.send('usuarios');
});

module.exports = router;
