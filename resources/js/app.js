require('./bootstrap');

$(document).ready(function() {

    $('#task_list_id').on('change', function() {
        let text = $.trim( $("#task_list_id option:selected").text());
        $('#name').val(text);
    });

    $.fn.datepicker.dates['ru'] = {
        days:["Воскресенье","Понедельник","Вторник","Среда","Четверг","Пятница","Суббота"],
        daysShort:["Вск","Пнд","Втр","Срд","Чтв","Птн","Суб"],daysMin:["Вс","Пн","Вт","Ср","Чт","Пт","Сб"],
        months:["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"],
        monthsShort:["Янв","Фев","Мар","Апр","Май","Июн","Июл","Авг","Сен","Окт","Ноя","Дек"],
        today:"Сегодня",
        clear:"Очистить",
        format:"dd.mm.yyyy",
        weekStart:1,
        monthsTitle:"Месяцы"
    };

    $('.datepicker').datepicker({
        format: "dd.mm.yyyy",
        language: "ru"
    });

    $( ".city" ).change(function() {
        window.location.href = baseUrl() + '/city/' + $(this).children("option:selected").val();
    });

    $('#btn-add-executer').click(function(){
        let executerSelected = $('#executer_id');

        let userName   = executerSelected.children("option:selected").text();
        let executerId = executerSelected.children("option:selected").val();

        if (executerId ===  '') {
            alert('Выберите сотрудника из списка!');
            return;
        }

        $('.list-add-executer').append("<li> " + userName + "<a href='#' id='" + executerId +"'class='float-right executer-delete'><i class='fas fa-trash'></i></a><input id='inputExecuterId " + executerId + "' name='executers[]' type='hidden' value = '" + executerId + "' ></li>");

    });

    $('.executer-delete').click(function(){
        $('#executerId' + this.id).remove();
        $('#inputExecuterId' + this.id).remove();
    });

    $('.list-dashboard-month a').click(function(){

        let idTable = this.id.replace('link-month-id', 'calendar-month-id');

        $('.list-dashboard-month li a').removeClass("month-active-link");
        $(this).addClass('month-active-link');

        $('.dashboard-current-month table').removeClass("calendar-active");

        $('#' + idTable).addClass("calendar-active");

    });


    $('.calendar-day-click').click(function(){

        let day = this.id.replace('day', 'nf-task');
        let dayTitle = this.id.replace('day', '');
        dayTitle = dayTitle.substring(0, 5);
        let monthId = dayTitle.substring(3, 6);

        $('.not-finished-tasks li').removeClass("active-task");

        $('.' + day).addClass("active-task");

        $('.not-finished-title').html('Задачи на ' + dayTitle.substring(0,2) + ' ' + getMonthName(monthId).toLowerCase());

    });
});


function getMonthName(monthId) {
    monthId = parseInt(monthId);

    if (monthId === 1)
        return 'Января';

    if (monthId === 2)
        return 'Февраль';

    if (monthId === 3)
        return 'Марта';

    if (monthId === 4)
        return 'Апреля';

    if (monthId === 5)
        return 'Мая';

    if (monthId === 6)
        return  'Июня';

    if (monthId === 7)
        return 'Июля';

    if (monthId === 8)
        return 'Августа';

    if (monthId === 9)
        return 'Сентября';

    if (monthId === 10)
        return 'Октября';

    if (monthId === 11)
        return 'Ноября';

    if (monthId === 12)
        return 'Декабря';
}


function baseUrl(){
	let getUrl = window.location;

	if (getUrl.host === 'localhost')
		return getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1] + '/' + getUrl.pathname.split('/')[2];

	return getUrl .protocol + "//" + getUrl.host + "/";
}