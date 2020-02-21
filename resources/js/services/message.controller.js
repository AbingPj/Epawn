import Vue from 'vue';
import Swal from 'sweetalert2';
require ('../bootstrap');

export default {
    methods : {
      Prompt(title,message, position, isToast, duration){
        position = position || 'top';
        isToast = isToast || false;
        duration = duration || 3000;

        Swal.fire({
            title : title,
            text : message,
            toast : isToast,
            timer : duration
        })
      }
    }
}