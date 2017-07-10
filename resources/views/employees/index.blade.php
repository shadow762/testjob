<?php
/**
 * Created by PhpStorm.
 * User: vkazalin
 * Date: 10.07.2017
 * Time: 10:36
 */
?>
<section id="employees">
    {!! link_to_route('employee.form', 'Добавить сотрудника') !!}
    <fieldset>
        {{ Form::text('search_query', null, ['placeholder' => 'Поиск', 'v-model' => 'options.search_query']) }}
        {{ Form::checkbox('sex', 1, false, ['id' => 'sex_male', 'v-model' => 'options.search_sex']) }}
        {{ Form::label('sex_male', 'Муж') }}
        {{ Form::checkbox('sex', 2, false, ['id' => 'sex_female', 'v-model' => 'options.search_sex']) }}
        {{ Form::label('sex_female', 'Жен') }}

        {{  Form::text('age_from', null, ['placeholder' => 'с', 'v-model' => 'options.search_age_from']) }}
        {{  Form::text('age_to', null, ['placeholder' => 'по', 'v-model' => 'options.search_age_to']) }}

        {{ Form::submit('Поиск', ['@click' => 'get_employees()']) }}
    </fieldset>
    <table border="1">
        <thead>
            <tr>
                <td>№ id</td>
                <td>Фото</td>
                <td>ФИО</td>
                <td>Возраст</td>
                <td>Пол</td>
                <td>Действие</td>
            </tr>
        </thead>
        <tbody>
                <tr v-for="employee in employees">
                    <td>@{{ employee.id }}</td>
                    <td>
                        <div class="employee-thumb" :style="'background-image:url(' + employee.image + ')'">
                            <div class="employee-image"><img :src="employee.image"></div>
                        </div>
                    </td>
                    <td>@{{ employee.surname }} @{{ employee.name }} @{{ employee.lastname }}</td>
                    <td>@{{ employee.bithday }} лет</td>
                    <td :class="employee.sex.name == 'Жен.' ? 'female' : 'male'">@{{ employee.sex.name }}</td>
                    <td><a :href="employee.edit_link">Ред</a>, <a @click.prevent="deleteEmployee(employee.id)" :href="employee.delete_link">удал</a></td>
                </tr>
        </tbody>
    </table>

    <ul class="pagination">
        <li v-for="page in pagination.last_page" @click="get_employees(page)">@{{ page }}</li>
    </ul>
</section>
<script>
    window.Laravel = <?php echo json_encode([ 'csrfToken' => csrf_token(), ]); ?>
</script>
<script src="{{asset('js/app.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/app.css')}}">