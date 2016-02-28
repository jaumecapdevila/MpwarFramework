# MpwarFramework
**MpwarFramework** nace fruto de una práctica de la asignatura de Frameworks del Master de Programación en Alto Rendimiento de la Universidad de la Salle. Dispone de un conjunto de componentes que facilitan a sus usuarios la creación de aplicaciones web.

## Instalación

* El primer paso para poder instalar este Framework es tener instalado Composer. Puedes consultar la guía de instalación de Composer [en este enlace.](https://getcomposer.org/doc/00-intro.md) 
2. Una vez instalado debes crear un fichero composer.json en la carpeta raíz de tu proyecto.
3. Una vez creado este fichero deberás añadirle los siguientes campos:

```
"repositories": [
    {
      "type":"vcs",
      "url":"https://github.com/jaumecapdevila/MpwarFramework"
    }
  ],
  "require": {
    "php": ">=5.5.30",
    "jaumecapdevila/MpwarFramework": "dev-master"
  }
```
* Finalmente deberás ejecutar Composer para que instale las nuevas dependencias con el siguiente comando:

	```
	php composer.phar install
	```
	
## Componentes 
Una vez instalado el Framework ya puedes disponer en tu aplicación de cada uno de sus componentes. A continuación se explican más en detalle cada uno de ellos juntamente con su modo de empleo.

### Antes de empezar...
Antes de empezar recuerda añadir a tu archivo principal el autoloader de composer tal y como se indica a continuación:

```
require __DIR__ . '/vendor/autoload.php';
```
### Service Container
Este Framework dispone de un Service Container que permite instanciar cualquiera de los componentes del Framework sin necesidad de indicar sus dependencias.
Se inicializa automáticamente en el componente Bootstrap. Únicamente dispone de una función que recibe por parámetro el nombre del servicio que se quiere incializar y devuelve una instancia de dicho servicio. En el ejemplo siguiente se utiliza la función del Service Container para instanciar una nueva Request:

```
$request = ServiceContainer::getInstanceOf("Request");
```

### Bootstrap
Bootstrap es el componente principal del Framework y se encarga de inicializar el Service Container. Para empezar a utilizar este componente añade estas líneas a tu código:

```
use MpwarFramework\Component\Bootstrap\Bootstrap;
$app = new Bootstrap();
```
Este componente dispone de dos funciones principales. La primera es un *Setter* que permite indicar a la aplicación en qué entorno nos encontramos (desarrollo o producción). Para indicar el entorno puedes utilizar la función *setEnvironment* de la siguiente forma:

```
$app->setEnvironment("PROD");
```
La segunda función se encarga de procesar la Request que recibe por parámetro y mostrar la Response correspondiente. Para ejecutarla simplemente haz la llamada de la siguiente manera:

```
$app->execute($request);
```

### Request
El componente Request se encarga de guardar la información referente a las cookies, la sesión del usuario, la url especificada y el tipo de petición que se ha recibido para dicha url. Una vez generada una instancia de este componente se le debe pasar a la función *execute* del componente Bootstrap para que sea procesada. Para crear una nueva instancia de Request se debe utilizar el Service Container de la siguiente manera: 

```
$request = ServiceContainer::getInstanceOf("Request");
```

### Response
El componente Response se encarga de generar una respuesta para la petición recibida (Request). El Framework dispone de dos tipos de Response distintas, una en formato HTML y otra en JSON. Para utilizar la primera se debe llamar a la función del Service Container de la siguiente manera:

```
$response = ServiceContainer::getInstanceOf("htmlResponse");
```
Si en cambio se prefeire recibir una respuesta en formato JSON:

```
$response = ServiceContainer::getInstanceOf("jsonResponse");
```
Los dos tipos de respuesta disponen de tres funciones principales. La primera de ellas permite introducir el contenido que se quiere devolver como respuesta. Esta función recibe un String con el contenido deseado. Como se explicará más adelante el Framework dispone de dos sistemas de Templating diferentes, Smarty y Twig. Para introducir nuevo contenido a la Respuesta haz la siguiente llamada a la función *setContent*: 

```
$response->setContent("<h1>Cool!</h1>");
```

Por otra parte también dispone de otra función que permite escoger entre tres Status Code distintos: 

1. HTTP_OK 
2. HTTP_FORBIDDEN
3. HTTP_ NOT_ FOUND

Para especificar cual de ellas debe utilizar la Response se tiene que emplear la función setStatusCode:

```
$response->setStatusCode($response::HTTP_OK);
```
Cómo se puede observar en el ejemplo los tres Status Code són constantes del objeto Response.

Finalmente la última función permite enviar esta Respuesta:

```
$response->Send();
```

### Templating
Tal y como se ha comentando anteriormente el Framework dispone de dos sistemas de Templates distintos: Twig y Smarty. Para poder utilizar dichos sistemas de template debes hacer que tus controladores hereden del controlador base *Controller* para poder utilizar su función *renderFile*, que recibe por parámetro el nombre del archivo que se quiere renderizar y un Array con los parámetros que se le quieran pasar al template. 

```
use MpwarFramework\Component\Controller\Controller;

class homeController extends Controller
{
	public function exampleFunction ($params) {
		$content = $this->renderFile('/Home/Views/home.tpl',$params);
	}
}
```
Tal y como se puede observar en el ejemplo anterior la función *renderFile* devuelve un String con el resultado de renderizar los templates (Tiwg o Smarty) y el valor de las variables que se le han pasado. Para utilizar un template u otro únicamente se debe cambiar la terminación del archivo que se quiere renderizar (.twig para Twig y .tpl para Smarty).

### Repository
El Framework también dispone de componente para tratar con bases de datos MySQL. Para crear una nueva instancia de este componente se debe utilizar el Service Container:

```
$mysqlRepo = ServiceContainer::getInstanceOf("MysqlRepository");
```
Una vez inicializado se puede utilizar la función *setDBConnectionParameters* para especificar los datos para conectarse a la base de datos deseada. Esta función recibe cuatro parámetros:

1. Host 
2. Database
3. User
4. Password

La llamada a dicha función se puede efectuar de la siguiente manera: 

```
$mysqlRepo = $mysqlRepo->setDBConnectionParameters("host", "database", "user", "password");
```
Una vez efectuada la conexión con la base de datos ya se pueden realizar tantas queries como sean necesarias. Para ello se debe utilizar la función *exectueQuery* que recibe por parámetro la query a realizar y los parámetros (en caso de que tenga). Este componente utiliza PDO para preparar y ejectuar las queries, y es por eso que el segundo parámetro tiene que ser un Array con los valores que PDO deberá remplazar en la query ua vez preparada. Para entender mejor su funcionamiento se puede observar el ejemplo siguiente:

```
$values = [$_POST["email"],$_POST["password"]];
$query = <<<QUERY
  INSERT INTO Table (user_email,user_password) VALUES(?,?);
QUERY;
$result = $mysqlRepo->exectueQuery($query, $values);
```
Tal y como se puede observar primero de todo se crea un Array con los valores que PDO utilizará para reemplazar los "?" presentes en la query. A continuación se crea la query deseada y finalmente se utiliza la función *exectueQuery* para ejecutarla. La función devuelve true o false en caso de que la query no sea del tipo SELECT o el valor de la búsqueda en caso contrario. 

##Futuro del Framework
Este Framework sigue en desarrollo y necesita aún mucho cariño, peró seguiré trabajando en él para mejorar y aumentar sus funcionalidades.  
