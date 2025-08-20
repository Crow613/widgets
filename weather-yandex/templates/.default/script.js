
class WeatherManager {
    constructor() {
        this.streamWidget =  document?.querySelector('#sidebar');
        console.log(this.streamWidget)
        this.#createWidget(this.streamWidget)
    }
   async #createWidget(widgetBlock) {
        if (!widgetBlock) setTimeout(() => this.#createWidget(), 500);
       console.log(widgetBlock)
        const newWidget = document?.querySelector('.weather-widget')
        if (newWidget) return;

        const dataWeather =  await this.getWeather('getWeather')
        if (!dataWeather) return;
        const widget = BX.create('div', {
            props: { className: 'weather-widget' },
            children: [
                BX.create("div", {
                    props: { className: 'weather-widget-time-block' },
                    children: [
                        BX.create("p", {
                            props: { className: 'weather-widget-subtitle' },
                            text: `дата: ${dataWeather.data}`,
                            style: { fontWeight: 'bold'}
                        }),
                        BX.create("p", {
                            props: { className: 'weather-widget-subtitle' },
                            text: `время: ${dataWeather.time}`,
                            style: { fontWeight: 'bold' }
                        }),
                    ]
                }),
                BX.create("p", {
                    props: { className: 'weather-widget-title' },
                    text: `Погода в: ${dataWeather.city}`,
                    style: { fontWeight: 'bold', marginBottom: '3px' }
                }),
                BX.create("img", {
                    attrs: {
                        src:  '/local/components/widgets/weather-yandex/templates/.default/weather.svg',
                        alt: "Weather icon",
                        class: "weather-icon"
                    }
                }),
                BX.create("div", { props: { className: 'weather-widget-items' }, children: [
                        BX.create("span", { text: `Температура: ${dataWeather.temp} °C` }),
                        BX.create("span", { text: `Ощущается как: ${dataWeather.feels} °C` }),
                        BX.create("span", { text: `Влажность: ${dataWeather.humidity} %` }),
                        BX.create("span", { text: `Скорость ветра: ${dataWeather.wind} м/с` })
                    ]})
            ]
        });
       if (widgetBlock.children.length > 4) {
           widgetBlock.children[4].after(widget);
       } else {
           widgetBlock.appendChild(widget);
       }
    }
    async getWeather(action, data = {}) {
        try {
            const response = await BX.ajax.runComponentAction('widgets:weather-yandex', action,
                {
                    mode: 'ajax',
                    data: {data:data}
                }
            );
            return  response.data;
        } catch (e) {
            console.error('error get weather', e);
        }
    }
}
BX.ready(() => new WeatherManager());
