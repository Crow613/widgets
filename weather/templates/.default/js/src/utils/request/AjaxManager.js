
const AjaxManager = {

   async getWeather(component,action,method='GET',data={}){
        try {
            const response = await BX.ajax.runComponentAction('widgets:weather', 'getWeather',
                {
                    mode: 'ajax',
                    method:method,
                    data: {data:data}
                });        
                if(response.status !== "success") {
                    throw new Error("Error getting weather");
                }
                return response.data;
            } catch (e) {
                
            }
    }
}

export default AjaxManager
