# PRUEBA TÉNCICA ORBYS - BACKEND
Backend con SYMFONY

### Datos generales

**- Autor del proyecto:** Alejandro López Bellés

**- Título del proyecto:** PRUEBA TÉCNICA ORBYS - BACKEND

**- Fecha:** 03/03/2023

 ### Tecnologías  y dependencias
SYMFONY + PHP + DOCTRINE + COMPOSER

 ### IMPORTADOR ARCHIVO JSON
 
 Para crear el importador para el archivo JSON y pasar esta información a la base de datos he seguido el siguiente método: 
 - He creado la entidad 'Book' con todos los campos que contiene el JSON. 
 - Creo un controlador 'ImportBooksController' para crear una tabla en base de datos que contenga estos campos. Este controlador crea un nuevo objeto Libro, establece sus atributos y utiliza el método 'persist' del EntityManager para registrar el objeto como nuevo en el contexto de persistencia. Finalmente, el método flush guarda los cambios en la base de datos. 

 ### AÑADIR REGISTRO A LA BASE DE DATOS
 
 - Creo un formulario 'BookType" para añadir un nuevo libro, con todos los campos que se deben rellenar. 
 - Creo un controlador para añadir un nuevo libro utilizando el formulario anteriormente creado: "AddBookController" que maneja la lógica para añadir un nuevo libro a la base de datos. 

 ### ELIMINAR REGISTRO Y OBTENER LISTADO DE LIBROS DE LA DB
 
 El resto de controladores sería 'DeleteBookController' para eliminar un registro de la base de datos y 'GetBookController' con las acciones para poder obtener el listado de libros. 

