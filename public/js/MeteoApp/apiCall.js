class ApiCall
{

	constructor()
	{
		this.apiKey = '262ed8d0e9d21c922440322a3458ce1d'
		this.pixaBayApiKey = '14921257-196d6ecb2b2d3811309d7c29d'
		this.city = undefined
		this.view = new View();
		// this._temp = undefined
	}

	/**
	 * @param string la clé api
	 */
	setApiKey(apiKey)
	{
		this.apiKey = apiKey
	}

	/**
	 * @return string return l'apiKey
	 */
	getApiKey()
	{
		return this.apiKey
	}

	/**
	 * @param string le nom de la ville
	 */
	setCity(city)
	{
		this.city = city
	}

	/**
	 * @return string nom de la cité
	 */
	getCity()
	{
		return this.city
	}
	/**
	 * appel api pour current temp
	 */
	currentTemp()
	{
		fetch('http://api.openweathermap.org/data/2.5/weather?q=' + this.city + '&units=metric&lang=fr&appid=' + this.apiKey)
			.then(response =>
			{
				console.log('Response:', response)
				return response.json();

			})
			.then((data) =>
			{
				this.handleStatusCode(data)
			})
			.catch(error =>
				console.log(error)
			)

	}
	/**
	 * appel api pour forecast temp
	 */
	forecastTemp()
	{
	    fetch('http://api.openweathermap.org/data/2.5/forecast?q='+this.city+'&units=metric&lang=fr&appid='+this.apiKey)
	    .then(response =>
	        {
	            console.log('Response:', response)
	            return response.json();
	        })
	        .then((data)=>
	        {
	            this.handleStatusCodeForecast(data)
	        })
	        .catch(error =>
	            console.log(error))

	}
	getImage(data)
	{
		fetch('https://pixabay.com/api/?key='+this.pixaBayApiKey+'&q='+data.name+'&safesearch=true&per_page=10&category=travel&image_type=photo')
		.then(response =>
			{
				return response.json();
			})
			.then((dataPixaBay) =>
			{
				this.view.getImage(dataPixaBay)
			})
			.catch(error =>
				console.log(error)
			)
	}


	/**
	 * Permet de faire des actions par rapport aux status code recu lors de la requete fetch.
	 * @param json l'objet recu grace a la promesse
	 */
	handleStatusCode(data)
	{
		switch (data.cod)
		{
			case 200:
				this.getImage(data)
				this.view.handleSuccess(data)
				this.view.getgradiant()
				break;
			case "400":
				this.view.handleFail("Vous n'avez pas rentré le nom d'une ville dans le champ de saisie")
				break;
			case 401:
				this.view.handleFail("Le serveur n'a pas réussi à vous authentifier")
				break;
			case "404":
				this.view.handleFail("Nous n'avons aucune données sur la ville que vous avez saisie. Veuillez vérifier l'orthographe.")
				break;
			case 500:
				$icon.removeChild($icon.childNodes[0])
				this.view.handleFail("Il est impossible de se connecter au serveur")
				break;
			case 503:
				$icon.removeChild($icon.childNodes[0])
				this.view.handleFail("Le serveur est en cours de maintenance")
				break;
			default:
				this.view.handleFail("Une erreur inconnue est survenue")
				break;
		}
	}



	/**
	 * Permet de faire des actions par rapport aux status code recu lors de la requete fetch.
	 * @param json l'objet recu grace a la promesse
	 */
	handleStatusCodeForecast(data)
	{
	
		switch (data.cod)
		{
			case "200":
				
	this.view.handleSuccessForecast(data)
				break;
			case "400":

				$city.textContent = "";
				$temp.textContent = "Vous n'avez pas rentré le nom d'une ville dans le champ de saisie"
				console.log('Vous navez pas rentré le nom dune ville')
				break;
			case 401:
				$city.textContent = "";
				$temp.textContent = "Le serveur n'a pas réussi à vous authentifier"
				console.log('mauvaise authentification')
				break;
			case "404":

				$city.textContent = "";
				$temp.textContent = "Nous n'avons aucune données sur la ville que vous avez saisie. Veuillez vérifier l'orthographe."
				console.log('la ville nexiste pas')
				break;
			case 500:

				$city.textContent = "";
				$temp.textContent = "Il est immpossible de se connecter au serveur"
				console.log('immpossible de se connecter au serveur')
				break;
			case 503:

				$city.textContent = "";
				$temp.textContent = "Le serveur est en cours de maintenance"
				console.log('Le serveur est en maintenance')
				break;
			default:
				$city.textContent = "";
				$temp.textContent = "Une erreur inconnue est survenue"
				console.log('une erreur inconnue est survenue')
				break;
		}
	}


}