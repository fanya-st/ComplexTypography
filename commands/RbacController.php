<?php
namespace app\commands;

use app\rbac\DesignerRule;
use app\rbac\ManagerRule;
use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        // добавляем разрешения
        $designerRule = new DesignerRule();
        $auth->add($designerRule);

        $managerRule = new ManagerRule();
        $auth->add($managerRule);

        //Редактирование этикетки
        $updateLabel = $auth->createPermission('updateLabel');
        $updateLabel->description = 'Редактирование этикетки';
        $auth->add($updateLabel);

        //Редактирование заказа
        $updateOrder = $auth->createPermission('updateOrder');
        $updateOrder->description = 'Редактирование заказа';
        $auth->add($updateOrder);

        //Редактирование отгрузки
        $updateShipment = $auth->createPermission('updateShipment');
        $updateShipment->description = 'Редактирование отгрузки';
        $auth->add($updateShipment);

        //Отметка о дизайн готов
        $designReadyLabel = $auth->createPermission('designReadyLabel');
        $designReadyLabel->description = 'Отметка о дизайн готов';
        $auth->add($designReadyLabel);


        //Редактирование заказчика
        $updateCustomer = $auth->createPermission('updateCustomer');
        $updateCustomer->description = 'Редактирование заказчика';
        $auth->add($updateCustomer);

        //Редактирование своего ресурса(менеджер)
        $updateByOwnerManager = $auth->createPermission('updateByOwnerManager');
        $updateByOwnerManager->description = 'Редактирование своего ресурса(менеджер)';
        $updateByOwnerManager->ruleName = $managerRule->name;
        $auth->add($updateByOwnerManager);

        //Редактирование своего ресурса(дизайнер)
        $designReadyOwnLabel = $auth->createPermission('designReadyOwnLabel');
        $designReadyOwnLabel->description = 'Редактирование своего ресурса(дизайнер)';
        $designReadyOwnLabel->ruleName = $designerRule->name;
        $auth->add($designReadyOwnLabel);

        // добавляем роли
		$driver = $auth->createRole('driver');
        $driver->description='Водитель';
		$manager = $auth->createRole('manager');
        $manager->description='Менеджер';
		$accountant = $auth->createRole('accountant');
        $accountant->description='Бухгалтер';
		$logistician = $auth->createRole('logistician');
        $logistician->description='Логист';
		$rewinder = $auth->createRole('rewinder');
        $rewinder->description='Перемотчик';
        $technolog = $auth->createRole('technolog');
        $technolog->description='Технолог';
        $packer = $auth->createRole('packer');
        $packer->description='Упаковщик';
		$laboratory = $auth->createRole('laboratory');
        $laboratory->description='Лаборант';
		$prepress = $auth->createRole('prepress');
        $prepress->description='Допечатник';
		$designer_admin = $auth->createRole('designer_admin');
        $designer_admin->description='Начальник отдела дизайна';
        $designer = $auth->createRole('designer');
        $designer->description='Дизайнер';
        $printer = $auth->createRole('printer');
        $printer->description='Печатник';
        $manager_admin = $auth->createRole('manager_admin');
        $manager_admin->description='Начальник отдела продаж';
        $warehouse_manager = $auth->createRole('warehouse_manager');
        $warehouse_manager->description='Заведующий складом';
        $admin = $auth->createRole('admin');
        $admin->description='Администратор';

        $auth->add($driver);
        $auth->add($accountant);
        $auth->add($designer);
        $auth->add($logistician);
        $auth->add($packer);
        $auth->add($rewinder);
        $auth->add($technolog);
        $auth->add($printer);
        $auth->add($prepress);
        $auth->add($laboratory);
        $auth->add($designer_admin);
        $auth->add($manager);
        $auth->add($manager_admin);
        $auth->add($warehouse_manager);
        $auth->add($admin);


        // добавляем родительские связи
        $auth->addChild($updateByOwnerManager,$updateCustomer);
        $auth->addChild($updateByOwnerManager,$updateLabel);
        $auth->addChild($updateByOwnerManager,$updateShipment);
        $auth->addChild($updateByOwnerManager,$updateOrder);
        $auth->addChild($manager,$updateByOwnerManager);

        $auth->addChild($designReadyOwnLabel,$designReadyLabel);
        $auth->addChild($designer,$designReadyLabel);

        $auth->addChild($designer_admin,$designer);
        $auth->addChild($designer_admin,$prepress);
        $auth->addChild($designer_admin,$designReadyLabel);
        $auth->addChild($manager_admin,$manager);
        $auth->addChild($manager_admin,$updateLabel);
        $auth->addChild($manager_admin,$updateShipment);
        $auth->addChild($manager_admin,$updateOrder);
        $auth->addChild($manager_admin,$updateCustomer);
        $auth->addChild($admin, $accountant);
        $auth->addChild($admin, $designer_admin);
        $auth->addChild($admin, $logistician);
        $auth->addChild($admin, $warehouse_manager);
        $auth->addChild($admin, $rewinder);
        $auth->addChild($admin, $driver);
        $auth->addChild($admin, $packer);
        $auth->addChild($admin, $manager_admin);
        $auth->addChild($admin, $manager);
        $auth->addChild($admin, $laboratory);
        $auth->addChild($admin, $technolog);
        $auth->addChild($admin, $designer);
        $auth->addChild($admin, $printer);

        // Назначение ролей пользователям. 1 и 2 это IDs возвращаемые IdentityInterface::getId()
        // обычно реализуемый в модели User.
        $auth->assign($admin, 1);
        $auth->assign($manager_admin, 3);
        $auth->assign($laboratory, 9);
        $auth->assign($manager, 5);
        $auth->assign($printer, 10);
        $auth->assign($technolog, 16);
        $auth->assign($rewinder, 11);
        $auth->assign($packer, 11);
        $auth->assign($logistician, 12);
        $auth->assign($packer, 12);
        $auth->assign($designer_admin, 8);
        $auth->assign($warehouse_manager, 13);
        $auth->assign($accountant, 14);
        $auth->assign($driver, 15);
        $auth->assign($designer, 6);
        $auth->assign($designer, 7);
        $auth->assign($prepress, 2);
        $auth->assign($manager, 4);
    }
}