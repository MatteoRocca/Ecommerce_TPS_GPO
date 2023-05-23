const mysql = require('mysql');

const express = require('express');
const app = express();
app.use(express.json());

const conn = mysql.createConnection({
    host:"localhost", user:"root", password:"", database:"archivio"
})

app.listen(3000, () => {
    console.log("Sono in ascolto sulla porta 3000");
})

app.get('/', (req, res) => {
    res.json("Benvenuto sul server");;
})

app.get('/location', (req, res) => {
    conn.query("SELECT * FROM localita",(err, result)=>{
        if(err) throw err;
        res.json(result);
    })
})

app.get('/place', (req, res) => {
    conn.query("SELECT Nome FROM localita",(err, result)=>{
        if(err) throw err;
        res.json(result);
    })
});

app.get('/provinces', (req, res) => {
    conn.query("SELECT Provincia FROM localita",(err, result)=>{
        if(err) throw err;
        res.json(result);
    })
});

app.get('/products', (req, res) => {
    conn.query("SELECT prodotto.Id AS ProdId, prodotto.Nome, Prezzo, venditore.Id AS VendId, venditore.Nome AS NomeVenditore, venditore.Cognome AS CognomeVenditore FROM prodotto JOIN venditore ON IdVenditore = venditore.Id",(err, result)=>{
        if(err) throw err;
        res.json(result);
    })
})

app.get('/repository', (req, res) => {
    conn.query("SELECT Nome, localita, Provincia FROM magazzino",(err, result)=>{
        if(err) throw err;
        res.json(result);
    })
})

app.post('/repository', (req, res) => {
    const magazzino = req.body;
    if(magazzino.Nome && magazzino.Localita && magazzino.Provincia){
        conn.query("INSERT INTO magazzino (Nome, Localita, Provincia) VALUES (?,?,?)",[magazzino['Nome'], magazzino['Localita'], magazzino['Provincia']],(err, result)=>{
            if(err) throw err;
            res.status(201).json("Magazzino aggiunto");
        })
    }else res.status(400).json("Mancano dei parametri");
})

app.get('/seller', (req, res) => {
    conn.query("SELECT Nome, Cognome FROM venditore",(err, result)=>{
        if(err) throw err;
        res.json(result);
    })
})

app.post('/seller', (req, res) => {
    const venditore = req.body;
    if(venditore.Nome && venditore.Cognome){
        conn.query("INSERT INTO venditore (Nome, Cognome) VALUES (?,?)",[venditore['Nome'], venditore['Cognome']],(err, result)=>{
            if(err) throw err;
            res.status(201).json("Venditore aggiunto");
        })
    }else res.status(400).json("Mancano dei parametri");
})