import DarkLighitUi from './ui/DarkLighitUi.js';
import DataTimeUi from './ui/DataTimeUi.js'
import FieldsUi from './ui/FieldsUi.js';

const WeatherComponent = {
    
    getWeatherWidget(data){
      return  BX.create('div', {
            props: { className: 'weather-widget dark' },
            children: [
                DarkLighitUi.getForm(),
                DataTimeUi.getForm(data),
                 BX.create("div", {
                    props: { className: 'weather-title-block' },
                    children:[
                             BX.create("p", {
                                props: { className: 'weather-widget-title' },
                                text: ` Погода в: ${data.city}`,
                                style: { fontWeight: 'bold', marginBottom: '3px' }
                            }),
                            BX.create("p", {
                                props: { className: 'weather-widget-temperaturs' },
                                text: `${data.temp}°С`,
                                style: { fontWeight: 'bold', marginBottom: '3px' }
                            })
                        ]
                }),
                BX.create("div", { props: { className: 'weather-widget-block' },
                    children: this.addFields(data)
                })
            ]
        });
    },
    addFields({temp, feels, humidity, wind}){
        const fieldsUi = new FieldsUi({
                blockClass: 'weather-action',
                iconClass: "weather-items-icon",
                textClass: 'weather-items-text',
                arrParams: [
                {
                    text: `Температура: ${temp}°C`,
                    icone: `/local/components/widgets/weather/templates/.default/image/icons/temp.svg`
                },
                {
                    text: `Ощущается как: ${feels} °C` ,
                    icone: `/local/components/widgets/weather/templates/.default/image/icons/icon.svg`
                },
                {
                    text: `Влажность: ${humidity} %` ,
                    icone: `/local/components/widgets/weather/templates/.default/image/icons/icon2.svg`
                },
                {
                    text: `Скорость ветра: ${wind} м/с`,
                    icone: `/local/components/widgets/weather/templates/.default/image/icons/icon3.svg`
                }
            ]
            })
            if(!fieldsUi.fields){
    
            }
            return fieldsUi.fields
    },
}
export default WeatherComponent;