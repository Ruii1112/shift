<template>
    <div class="reflect">
        <div class="table">
            <h3>一括設定</h3>
            <table border="1">
                <tr>
                    <th>曜日</th>
                    <th>希望時間</th>
                </tr>
                    <tr v-for="youbi in youbilist">
                        <td>{{ youbi }}</td>
                        <td><vue-timepicker
                            :name="nameDecision(youbi,'start')"
                            placeholder="時間を入力"
                            hour-label="時"
                            minute-label="分"
                            minute-interval="30"
                            advanced-keyboard
                            manual-input
                            auto-scroll
                        ></vue-timepicker> ~ 
                        <vue-timepicker
                            :name="nameDecision(youbi,'end')"
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
        </div>
        <div class="participate">
            <h3>希望</h3>
            <table border="1">
                <tr>
                    <th>日時</th>
                    <th>曜日</th>
                    <th>募集時間</th>
                    <th>希望開始時間</th>
                    <th>希望終了時間</th>
                </tr>
                <tr v-for="(time, index) in times">
                    <td>{{ time.date }}</td>
                    <td>{{ youbi_shift[index] }}</td>
                    <td>{{ time.start_time }} ～ {{ time.end_time }}</td>
                    <input type="hidden" :name="'time[' + index + '_date]'" :value="time.date"/>
                    <td><Time :name="'time[' + index + '_start_time]'" /></td>
                    <td><Time :name="'time[' + index + '_end_time]'"/></td>
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
          onChange: function() {
              console.log('変更されました')
          },
          nameDecision: function(youbi, check){
              let name;
              switch(youbi){
                  case "月":
                      name = 'mon_' + check;
                      break;
                  case "火":
                      name = 'tue_' + check;
                      break;
                  case "水":
                      name = 'wed_' + check;
                      break;
                  case "木":
                      name = 'thu_' + check;
                      break;
                  case "金":
                      name = 'fri_' + check;
                      break;
                  case "土":
                      name = 'sat_' + check;
                      break;
                  case "日":
                      name = 'sun_' + check;
                      break;
                  default:
                      name = "";
              }
              return name;
          }
      }
    };
</script>