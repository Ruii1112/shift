<template>
    <div class="reflectiton">
        <div class="table">
            <h3>一括設定</h3>
            <table class="setting" border="1">
                <tr>
                    <th>曜日</th>
                    <th>希望開始時間</th>
                    <th>希望終了時間</th>
                </tr>
                    <tr v-for="youbi in youbilist" class="setting_youbi">
                        <td class="day">{{ youbi }}</td>
                        <td class="start"><vue-timepicker
                            placeholder="時間を入力"
                            hour-label="時"
                            minute-label="分"
                            minute-interval="30"
                            advanced-keyboard
                            manual-input
                            auto-scroll
                        ></vue-timepicker></td>
                        <td class="end"><vue-timepicker
                            placeholder="時間を入力"
                            hour-label="時"
                            minute-label="分"
                            minute-interval="30"
                            advanced-keyboard
                            manual-input
                            auto-scroll
                        ></vue-timepicker></td>
                    </tr>
            </table>
            <input type="button" value='一括反映' @click="reflect"/>
        </div>
        <div class="participate">
            <h3>希望</h3>
            <table class="want" border="1">
                <tr>
                    <th>日時</th>
                    <th>曜日</th>
                    <th>募集時間</th>
                    <th>希望開始時間</th>
                    <th>希望終了時間</th>
                </tr>
                <tr v-for="(time, index) in times" class="want_youbi">
                    <td>{{ time.date }}</td>
                    <td class="day">{{ youbi_shift[index] }}</td>
                    <td>{{ time.start_time }} ～ {{ time.end_time }}</td>
                    <input type="hidden" :name="'time[' + index + '_date]'" :value="time.date"/>
                    <td class="start"><Time :name="'time[' + index + '_start_time]'" :value="start_value[index]"/></td>
                    <td class="end"><Time :name="'time[' + index + '_end_time]'" :value="end_value[index]"/></td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
    import Time from "./TimeComponent"
    import VueTimepicker from 'vue2-timepicker/src/vue-timepicker.vue'
    
    export default {
      components: { 
          Time,
          'vue-timepicker': VueTimepicker,
      },
      data(){
          return {
              youbilist : ['月','火','水','木','金','土','日'],
              time : '',
              start_value: ["","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","",""],
              end_value : ["","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","",""],
          }
      },
      props:{
          times:{
              required:true
          },
          youbi_shift:{
              required:true
          }
      },
      methods: {
          reflect: function(){
            let test = [];
            let setting_rows = document.getElementsByClassName('setting_youbi');
            for(let i = 0 ; i < setting_rows.length ; i++){
                let start = setting_rows[i].getElementsByClassName('start');
                let start_input = start[0].getElementsByTagName('input');
                let end = setting_rows[i].getElementsByClassName('end');
                let end_input = end[0].getElementsByTagName('input');
                let day = setting_rows[i].getElementsByClassName('day');
                let day_input = day[0].innerHTML;
                test[day_input] = {'start':start_input[0].value,'end':end_input[0].value};
            }
            let want_rows = document.getElementsByClassName('want_youbi');
            for(let i = 0 ; i < want_rows.length ; i++){
                let youbi_test = want_rows[i].getElementsByClassName('day')[0].innerHTML;
                if(youbi_test == '月'){
                   this.start_value.splice(i, 1, test['月'].start); 
                   this.end_value.splice(i, 1, test['月'].end); 
                }else if(youbi_test == '火'){
                   this.start_value.splice(i, 1, test['火'].start); 
                   this.end_value.splice(i, 1, test['火'].end); 
                }else if(youbi_test == '水'){
                   this.start_value.splice(i, 1, test['水'].start);
                   this.end_value.splice(i, 1, test['水'].end); 
                }else if(youbi_test == '木'){
                   this.start_value.splice(i, 1, test['木'].start);
                   this.end_value.splice(i, 1, test['木'].end); 
                }else if(youbi_test == '金'){
                   this.start_value.splice(i, 1, test['金'].start);
                   this.end_value.splice(i, 1, test['金'].end); 
                }else if(youbi_test == '土'){
                   this.start_value.splice(i, 1, test['土'].start); 
                   this.end_value.splice(i, 1, test['土'].end); 
                }else if(youbi_test == '日'){
                   this.start_value.splice(i, 1, test['日'].start); 
                   this.end_value.splice(i, 1, test['日'].end); 
                }
            }
          }
      }
    };
</script>