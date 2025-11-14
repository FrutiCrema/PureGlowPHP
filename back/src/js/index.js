const express = require('express');
const app = express();
const cors = require('cors');
//const {Router} = require('express');
//const router = Router();
app.use(cors());
app.use('/',require('./routes/userRoutes'));




app.listen(3000,()=>{console.log("server on port: 3000")});

