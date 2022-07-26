
/* AFISAREA CATEGORIILOR DE COPACI*/
function afisareCategorii()
{
  cerere=new XMLHttpRequest();
  cerere.onreadystatechange=procesareRaspunsCategorii;
  cerere.open("GET","categorii-copaci.php");
  cerere.send(null);
}
function procesareRaspunsCategorii()
{
  if (cerere.readyState==4 && cerere.status==200)
 {
    raspuns=cerere.responseText;
    tinta=document.getElementById("categorii");
    tinta.innerHTML='';
    tinta.innerHTML+=raspuns;
  }
}


/* AFISAREA COPACILOR DINTR-O ANUMITA CATEGORIE*/
function afisareCopaci(idcategorie)
{    
    idcategorieArray = idcategorie.split("#"); /* ia id-ul si selecteaza doar ce e dupa # */
    idcategorie = idcategorieArray[1];

    cerere=new XMLHttpRequest();
    cerere.onreadystatechange=procesareRaspunsCopaci;
    cerere.open("GET","detalii-copaci.php?idcategorie="+idcategorie);
    cerere.send(null);

    /* COMPLETEAZA INPUT-UL ASCUNS "categorieSelectata" CU ID-UL CATEGORIEI SELECTATE */
    document.getElementById("categorieSelectata").value=idcategorie;   
}


function procesareRaspunsCopaci()
{
  if (cerere.readyState==4 && cerere.status==200)
 {
    tinta=document.getElementById("detalii-copaci");
    tinta.innerHTML='';
    raspuns=cerere.responseText;
    tinta.innerHTML+=raspuns;
  }
}




/*INSERAREA UNUI COPAC NOU*/
function inserareCopac()
{
    categorie = document.getElementById('categorieSelectata').value; /*id-ul categoriei selectate*/
    denumire = document.getElementById('denumire').value;
    inaltime = document.getElementById('inaltime').value;
    varsta = document.getElementById('varsta').value;
    continent = document.getElementById('continent').value;
    flori = document.getElementById('flori').value;
    imagine = document.getElementById('imagine').value;
    /* DUPA CE PRELUAM DATELE DIN FORMULAR, LE STERGEM IN FRONT END*/
    document.getElementById('inserare-copaci').reset();

    /* ALERTA DACA CAMPURILE NU SUNT COMPLETATE*/
    if(!categorie)
      {
        alert("Selectati o categorie!");
        return;
      }
    else if (!denumire||!inaltime||!varsta||!continent||!flori||!imagine)
    {
      alert("Completati toate campurile!");
      return;
    }

    cerere=new XMLHttpRequest();
    cerere.onreadystatechange=procesareRaspunsInserareCopaci;

    parametrii= "?categorie=" +categorie + 
                "&denumire=" +denumire+ 
                "&inaltime=" +inaltime + 
                "&varsta="+varsta + 
                "&continent="+continent +
                "&flori="+flori +
                "&imagine="+imagine;
    cerere.open("GET","inserare.php"+parametrii);
    cerere.send(null);
}
function procesareRaspunsInserareCopaci ()
{
  if (cerere.readyState==4 && cerere.status==200)
  {
     tinta=document.getElementById("detalii-copaci");
     tinta.innerHTML='';
     tinta.innerHTML='Inserare realizata cu succes!';
   }
}


/*STERGEREA UNUI COPAC*/
function stergereCopac(idcopac)
{
  idcopacArray = idcopac.split("#"); /* ia id-ul si selecteaza doar ce e dupa # */
  idcopac = idcopacArray[1];
  cerere=new XMLHttpRequest();
  cerere.onreadystatechange=procesareRaspunsStergereCopaci;
  cerere.open("GET","stergere.php?idcopac="+idcopac);
  cerere.send(null);
}
function procesareRaspunsStergereCopaci ()
{
  if (cerere.readyState==4 && cerere.status==200)
  {
     tinta=document.getElementById("detalii-copaci");
     tinta.innerHTML='';
     tinta.innerHTML='Stergere realizata cu succes!';
   }
}
