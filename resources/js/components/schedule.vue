<template>
    <div ref="schedule"></div>
</template>

<script>
    import { Calendar } from '@fullcalendar/core';
    import dayGridPlugin from '@fullcalendar/daygrid';
    import { Interaction } from '@fullcalendar/core';

    export default {

        mounted(){

            let calendar = new Calendar(this.$refs.schedule, {
                plugins: [ dayGridPlugin, Interaction ],
                defaultView: 'dayGridMonth',
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,dayGridWeek,dayGridDay'
                },
            });

            calendar.render();

        }
    }

</script>

<style>
    /* @import '~@fullcalendar/core/main.css'; */
</style>
