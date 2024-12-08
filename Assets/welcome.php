<!DOCTYPE html>
<html lang="en">
    <?php
        session_start();
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <title>Weather App</title>
</head>
<body style="background: #222;">


    <div class="container">

        <div class="row justify-center">

            <div class="col-md-7">

            <h4 class="text-light mt-4">Let's Forecast <?php echo $_SESSION['username']?>!!which city are we going with? </h4>
    
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
    </div>
    <div class="col-md-3">
    <div class="logout">
        <button class="btn btn-danger mt-3"><a href='logout.php'><i id="icons" class="bi bi-box-arrow-left"></i>&nbsp; Logout</a></button>

    </div>
    </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
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