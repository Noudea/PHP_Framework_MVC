
const check = (e) => {
    const form = new FormData(e.target);
    const city = form.get("city");
    let apiCall = new ApiCall();
    apiCall.setCity(city)
    apiCall.addimg
    apiCall.currentTemp()
    apiCall.forecastTemp()
    // apiCall.getImage()

    return false
    // apiCall(city,apiKey);
    
};
let $city = document.getElementById('city');
let $temp = document.getElementById('temp');
