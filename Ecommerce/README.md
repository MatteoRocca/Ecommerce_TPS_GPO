# Ecommerce_TPS_GPO
Scaricare i moduli node, non sono compresi qui per motivi di dimensione (express, mysql)

/ -> Rotta base di benvenuto

/location -> Rotta che mostra le località e le province

/place -> Rotta che mostra le località

/provinces -> Rotta che mostra le province

/products -> Rotta che mostra i prodotti disponibili

get /repository -> Rotta che visualizza i magazzini

post /repository -> Rotta per inserire un magazzino in formato JSON [magazzino['Nome'], magazzino['Localita'], magazzino['Provincia']]

get /seller -> Rotta che mostra i venditori

post /seller -> Rotta per inserire un venditore in formato JSON [venditore['Nome'], venditore['Cognome']]

N.B.: la listbox del file registrati.php dovrebbe riempirsi automaticamente, avviando il file api.js e chiudendolo poco dopo, ma non funziona, bisogna quindi avviare prima il file api.js
