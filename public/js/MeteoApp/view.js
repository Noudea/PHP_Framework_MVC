class View {
	constructor() {
		this.$cityName = document.createElement('h2')
		this.$current = document.getElementById('current')
		this.$icon = new Image()
		this.$temp = document.createElement('p')
		this.$description = document.createElement('p')
		this.$forecast = document.getElementById('forecast')
		this.$imageContainer = document.getElementById('imageContainer')
		this.$image = new Image()
		this.$error = document.getElementById('error')
		this.$gradientContainer = document.getElementById('gradiant')
	}

	/**
	 * permet d'afficher la température actuelle. affiche dans #current
	 * @param {les données meteo en format JSON} data 
	 */
	handleSuccess(data) {
		// console.log(this.$current.childNodes)
		for (let index = 1; index < this.$current.childNodes.length; index++) {
			this.$current.childNodes[index].classList.remove('none')
		}

		if (this.$current.childElementCount == 1) {
			this.$current.appendChild(this.$cityName)
			this.$current.appendChild(this.$temp)
			this.$current.appendChild(this.$description)
			this.$current.appendChild(this.$icon)
			this.$cityName.textContent = data.name
			this.$description.textContent = data.weather[0].description
			this.$temp.textContent = data.main.temp
			this.$icon.src = 'http://openweathermap.org/img/wn/' + data.weather[0].icon + '@2x.png';
		} else if (this.$current.childElementCount > 1) {
			this.$current.childNodes[1].textContent = data.name
			this.$current.childNodes[2].textContent = data.main.temp
			this.$current.childNodes[3].textContent = data.weather[0].description
			this.$current.childNodes[4].src = 'http://openweathermap.org/img/wn/' + data.weather[0].icon + '@2x.png'
			// this.$current.replaceChild(this.$icon2,this.$current.childNodes[1])
		}

	}
	/**
	 * permet d'afficher les prévisions. affiche dans #forecast
	 * 24h par 24h
	 * @param {les données meteo en format JSON} data 
	 */
	handleSuccessForecast(data) {

		this.$error.textContent = ''
		if (this.$forecast.childElementCount == 0) {

			// index +8 car +1 = +3h prevision. 8*3=24
			for (let index = 7; index < 39; index += 8) {
				luxon.Settings.defaultZoneName = "utc"
				const forecastContainer = document.createElement('div')
				const date = document.createElement('p')
				const description = document.createElement('p')
				const temp = document.createElement('p')
				const img = new Image
				const dateData = luxon.DateTime.fromSeconds(data.list[index].dt + data.city.timezone)
				forecastContainer.appendChild(img)
				this.$forecast.appendChild(forecastContainer)
				forecastContainer.appendChild(img)
				forecastContainer.appendChild(date)
				forecastContainer.appendChild(description)
				forecastContainer.appendChild(temp)
			}
		} else(this.$forecast.childElementCount > 1) 
		{
			this.$error.textContent = ''
			for (let index = 1; index < 5; index++) {
				const count = index * 8 - 1
				//utilisation de la librairie luxon
				luxon.Settings.defaultZoneName = "utc"
				const dateData = luxon.DateTime.fromSeconds(data.list[count].dt + data.city.timezone)
				this.$forecast.childNodes[index - 1].childNodes[0].src = 'http://openweathermap.org/img/wn/' + data.list[count].weather[0].icon + '@2x.png'
				this.$forecast.childNodes[index - 1].childNodes[1].textContent = dateData.day + "/" + dateData.month + "/" + dateData.year
				this.$forecast.childNodes[index - 1].childNodes[2].textContent = data.list[count].main.temp
				this.$forecast.childNodes[index - 1].childNodes[3].textContent = data.list[count].weather[0].description

			}
			/**
			 * permet a qu'apres une erreur de l'utilisateur (frappe,ville non existante ect) de reafficher les prévision meteo
			 */
			for (let index = 0; index < 5; index++) {
				this.$forecast.childNodes[index].style.border = "solid white"
				this.$forecast.childNodes[0].childNodes[index].classList.remove('none')
				this.$forecast.childNodes[1].childNodes[index].classList.remove('none')
				this.$forecast.childNodes[2].childNodes[index].classList.remove('none')
				this.$forecast.childNodes[3].childNodes[index].classList.remove('none')
			}
		}
	}

	/**
	 * 
	 * @param {string permet d'afficher un message d'erreur} errorMessage 
	 */
	handleFail(errorMessage) {
		this.$error.textContent = errorMessage

		for (let index = 1; index < this.$current.childNodes.length; index++) {
			this.$current.childNodes[index].classList.add('none')
		}

		for (let index = 0; index < 5; index++) {
			this.$forecast.childNodes[index].style.border = "none"
			this.$forecast.childNodes[0].childNodes[index].classList.add('none')
			this.$forecast.childNodes[1].childNodes[index].classList.add('none')
			this.$forecast.childNodes[2].childNodes[index].classList.add('none')
			this.$forecast.childNodes[3].childNodes[index].classList.add('none')
		}
	}

	/**
	 * cherche une image par rapport a la localisation de la meteo demande
	 * utilisation de l'api pixaBAy
	 * @param {string url de l'image} dataPixaBay 
	 */
	getImage(dataPixaBay) {
		function getRandomInt(min, max) {
			min = Math.ceil(min);
			max = Math.floor(max);
			return Math.floor(Math.random() * (max - min)) + min;
		}
		const randomNum = getRandomInt(0, dataPixaBay.hits.length)
		const imgUrl = dataPixaBay.hits[randomNum].largeImageURL
		this.$imageContainer.style.backgroundImage = 'url(' + imgUrl + ')'
	}

	/**
	 * choisi un gradiant aléatoire 
	 */
	getgradiant() {
		function getRandomInt(min, max) {
			min = Math.ceil(min);
			max = Math.floor(max);
			return Math.floor(Math.random() * (max - min)) + min;
		}
		const RandomNum = getRandomInt(2, 4)
		const RandomNum2 = getRandomInt(2, 4)

		if (this.$gradientContainer.classList.contains('gradiant' + [RandomNum])) {
			this.$gradientContainer.classList.remove('gradiant' + [RandomNum])
		} else {
			this.$gradientContainer.classList.add('gradiant' + [RandomNum])
		}
	}
}