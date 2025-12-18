import WeatherComponent from './src/components/WeatherComponent.js'
class WeatherManager {
    constructor() {
        this.streamWidget =  document?.querySelector('#sidebar');
        this.#createWidget(this.streamWidget)
    }
   async #createWidget(widgetBlock) {
        if (!widgetBlock) setTimeout(() => this.#createWidget(), 500);

        const newWidget = document?.querySelector('.weather-widget')
        const data = await this.getWeather();

        if (newWidget) return;

        const widget = WeatherComponent.getWeatherWidget(data)
        
       if (widgetBlock.children.length > 4) {
           widgetBlock.children[3].after(widget);
       } else {
           widgetBlock.appendChild(widget);
       }
    }
    getFilterWeather(dataWeather){
        if (!dataWeather) return;
        const city = (dataWeather.city !== null) ? dataWeather.city: "";
        const data = (dataWeather.data !== null) ? dataWeather.data: "--.--.--";
        const time = (dataWeather.time !== null)? dataWeather.time: "--:--";
        const temp = (dataWeather.temp !== null) ? dataWeather.temp : 0
        const feels = (dataWeather.feels !== null) ? dataWeather.feels:0
        const humidity = (dataWeather.humidity !== null) ? dataWeather.humidity : 0
        const wind = (dataWeather.wind !== null) ? dataWeather.wind : 0
        return {
            time:time, data:data, city:city,
            temp:temp, feels:feels, humidity:humidity,
            wind:wind
        }
    }
    async getWeather( data = {}) {
        try {
            const response = await BX.ajax.runComponentAction('widgets:weather', 'getWeather',
                {
                    mode: 'ajax',
                    data: {data:data}
                }
            );        
            if(response.status !== "success") {
                throw new Error("Error getting weather");
            }
            return  this.getFilterWeather(response.data);
        } catch (e) {
            console.error('error get weather', e);
        }
    }
}
BX.ready(() => new WeatherManager())



