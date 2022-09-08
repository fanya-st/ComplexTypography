<?
use yii\bootstrap5\Html;
?>

        <div class="row g-2 row-cols-lg-2 text-nowrap">

            <div class="col-lg">
                <div class="border p-3 rounded">
                    <h6 class="p-1 rounded">Заказы</h6>
                    <div class="d-lg-flex flex-wrap">
                        <div class="p-1"><?= Html::a('Редактирование заказов', ['cms/order-list'], ['class' => 'btn btn-primary']) ?></div>
                    </div>
                </div>
            </div>

            <div class="col-lg">
                <div class="border p-3 rounded">
                    <h6 class="p-1 rounded">Этикетки</h6>
                    <div class="d-lg-flex flex-wrap">
                        <div class="p-1"><?= Html::a('Редактирование этикеток', ['cms/label-index'], ['class' => 'btn btn-primary']) ?></div>
                    </div>
                </div>
            </div>

            <div class="col-lg">
                <div class="border p-3 rounded">
                    <h6 class="p-1 rounded">Материалы</h6>
                    <div class="d-lg-flex flex-wrap">
                        <div class="p-1"><?= Html::a('Редактирование втулок', ['cms/sleeve-index'], ['class' => 'btn btn-primary']) ?></div>
                    </div>
                </div>
            </div>

            <div class="col-lg">
                <div class="border p-3 rounded">
                    <h6 class="p-1 rounded">Параметры калькулятора</h6>
                    <div class="d-lg-flex flex-wrap">
                        <div class="p-1"><?= Html::a('Редактирование параметров машин', ['cms/calc-mashine-param-price-index'], ['class' => 'btn btn-primary']) ?></div>
                        <div class="p-1"><?= Html::a('Редактирование общих параметров', ['cms/calc-common-params-index'], ['class' => 'btn btn-primary']) ?></div>
                    </div>
                </div>
            </div>

            <div class="col-lg">
                <div class="border p-3 rounded">
                    <h6 class="p-1 rounded">Сотрудники</h6>
                    <div class="d-lg-flex flex-wrap">
                        <div class="p-1"><?= Html::a('Сотрудники', ['employee/list'], ['class' => 'btn btn-primary']) ?></div>
                        <div class="p-1"><?= Html::a('Привязка сотрудников к группам', ['cms/auth-assign-index'], ['class' => 'btn btn-primary']) ?></div>
                        <div class="p-1"><?= Html::a('Создание сотрудника', ['employee/create'], ['class' => 'btn btn-primary']) ?></div>
                        <div class="p-1"><?= Html::a('Электронный табель', ['time-tracker/index'], ['class' => 'btn btn-primary']) ?></div>
                        <div class="p-1"><?= Html::a('Киоск', ['time-tracker/kiosk'], ['class' => 'btn btn-primary']) ?></div>
                    </div>
                </div>
            </div>

            <div class="col-lg">
                <div class="border p-3 rounded">
                    <h6 class="p-1 rounded">Заказчики</h6>
                    <div class="d-lg-flex flex-wrap">
                        <div class="p-1"><?= Html::a('Редактирование заказчиков', ['cms/customer-index'], ['class' => 'btn btn-primary']) ?></div>
                        <div class="p-1"><?= Html::a('Редактирование списка субъектов РФ', ['cms/subject-index'], ['class' => 'btn btn-primary']) ?></div>
                        <div class="p-1"><?= Html::a('Редактирование списка регионов', ['cms/region-index'], ['class' => 'btn btn-primary']) ?></div>
                        <div class="p-1"><?= Html::a('Редактирование списка адм.центров', ['cms/town-index'], ['class' => 'btn btn-primary']) ?></div>
                        <div class="p-1"><?= Html::a('Редактирование списка улиц', ['cms/street-index'], ['class' => 'btn btn-primary']) ?></div>
                    </div>
                </div>
            </div>

            <div class="col-lg">
                <div class="border p-3 rounded">
                    <h6 class="p-1 rounded">Склады</h6>
                    <div class="d-lg-flex flex-wrap">
                        <div class="p-1"><?= Html::a('Редактирование складов', ['cms/warehouse-index'], ['class' => 'btn btn-primary']) ?></div>
                        <div class="p-1"><?= Html::a('Редактирование стелажей', ['cms/rack-index'], ['class' => 'btn btn-primary']) ?></div>
                        <div class="p-1"><?= Html::a('Редактирование полок', ['cms/shelf-index'], ['class' => 'btn btn-primary']) ?></div>
                    </div>
                </div>
            </div>


        </div>
