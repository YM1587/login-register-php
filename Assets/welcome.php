<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Weather App</title>
</head>
<body>
    
    <div class="card">
        <div class="search">
            <input type="text" name="city"  placeholder="enter city name" spellcheck="false">
            <button><img src="images/search.png" a></button>

        </div>
        <div class="error">
            <p>Invalid City Name</p>
        </div>
        <div class="weather">
            <img src="images/rain.png" class="weather-icon">
            <h1 class="temp">22°C</h1>
            <h2 class="city">New York</h2>
            <div class="details">
                <div class="col">
                    <img src="images/humidity.png" >
                    <div>
                        <p class="humidity">50%</p>
                        <p>Humidity</p>
                    </div>
            
                </div>
                <div class="col">
                    <img src="images/wind.png" >
                    <div>
                        <p class="wind">15 km/h</p>
                        <p>Wind Speed</p>
                    </div>
            
                </div>
                
            </div>
        </div>
    </div>
    <script>

        const apiKey= "fdb0e4ff3f67c4f0ddcc76de688e45f5";
        
        const searchBox=document.querySelector(".search input");
        const searchbtn=document.querySelector(".search button");
        const weatherIcon=document.querySelector(".weather-icon");


        async function checkWeather(city) {
            
            const apiUrl=`https://api.openweathermap.org/data/2.5/weather?q=${city}&units=metric&appid=${apiKey}`;

            const response= await fetch(apiUrl /*+ city /* + `appid=${apiKey}`*/);
            
            if(response.status==404){
                document.querySelector(".error").style.display="block";
                document.querySelector(".weather").style.display="none";

            }else{
                var data =await response.json();

            

document.querySelector(".city").innerHTML = data.name;
document.querySelector(".temp").innerHTML = Math.round(data.main.temp) + "°C";
document.querySelector(".humidity").innerHTML = data.main.humidity + "%";
document.querySelector(".wind").innerHTML = data.wind.speed + "km/h";

if (data.weather[0].main=="Clouds"){
    weatherIcon.src="images/clouds.png";

}else if(data.weather[0].main=="Clear"){
    weatherIcon.src="images/clear.png";

}else if(data.weather[0].main=="Rain"){
    weatherIcon.src="images/rain.png";

}else if(data.weather[0].main=="Drizzle"){
    weatherIcon.src="images/drizzle.png";

}else if(data.weather[0].main=="Mist"){
    weatherIcon.src="images/mist.png";
}
document.querySelector(".weather").style.display="block"; 
document.querySelector(".error").style.display="none";       

                
            }
           
    }
        searchbtn.addEventListener("click" ,()=>{
            checkWeather(searchBox.value);
        })
        
    </script>
</body>
</html>