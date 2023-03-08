<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Names Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the paginator library to build
    | the simple pagination links. You are free to change them to anything
    | you want to customize your views to better match your application.
    |
    */

    "nocategories" => "Нет категорий",
    "noinnercategories" => "Нет подкатегорий",
    "subcategories" => "Подкатегории",
    "novideo" => "Нет видео",
    "passwordmismatch" => "Пароль пуст или не соответствует",
    "makerreturn" => "Сделать возврат",
    "chooselang" => "Язык",

    'detailsMsg' => 'Подробности сообщения',
    'created_at' => 'Создано в',
    'createMsg' => 'Создать сообщение',
    'editMsg' => 'Редактировать сообщение',
    'emptyChat' => 'Чат пуст',
    'messages' => 'Сообщения',
    'messenger' => 'Чат',
    'openChat' => 'Нажмите на любого пользователя, чтобы открыть чат',
    'send' => 'Отправить',
    'subject' => 'Тема',
    'textMsg' => 'Текст сообщения',
    'typeYourMsgHere' => 'Введите ваше сообщение здесь...',
    'updatedAt' => 'Обновлено в',
    'areYouSureCart' => 'Вы уверены, что хотите удалить этот товар из корзины',

    //Users
    'errorEmptyEmployee' => 'Не удалось найти сотрудника',

    //User Profile
    'userupdated' => 'Профиль успешно обновлен',
    'changedpassword' => 'Пароль успешно изменен.',
    'incorrectpassword' => 'Неверный текущий пароль.',
    'areYouSureAccountDeletion' => 'Вы уверены, что хотите удалить свой аккаунт?',
    'successDeletedAccount' => 'Аккаунт успешно удален',
    'errorGetUser' => 'Не удалось найти пользователя',
    'successAddSkill' => 'Навык успешно добавлен',
    'infoAddSkill' => 'Все доступные навыки уже добавлены к вашему профилю',

    //Authenticator
    'errorAuthRegistered' => 'Ваш аккаунт еще не подтверждён',
    'errorAuthBlocked' => 'Ваш аккаунт заблокирован',
    'successAuthRegistered' => 'Ваш аккаунт зарегистрирован. Пожалуйста подождите, пока администратор подтвердит его.',
    'errorAuthCheck' => 'Вы не вошли в свой аккаунт',
    'successAuthLogin' => 'Вы успешно вошли в свой аккаунт',
    'errorUnauthAccess' => 'Несанкционированный доступ',

    //Orders
    'errorGetOrders' => 'Не удалось получить заказы',
    'successUpdateOrder' => 'Заказ успешно обновлен',
    'successOrderCancelled' => 'Успешно отменен заказ: ',
    'successReturnCreated' => 'Успешно создан возврат: ',
    'errorMoreHours' => 'Сумма часов специалиста превышает общее количество часов заказа',
    'errorLessHours' => 'Сумма часов специалиста отстает от общего количества часов заказа',
    'successCreateOrder' => 'Успешно создан заказ: ',
    'successAddOrderSpec' => 'Успешно добавлен специалист для заказа',
    'successUpdateOrderSpec' => 'Успешно обновлен специалист для заказа',
    'successDeleteOrderSpec' => 'Успешно удален специалист для заказа',
    'areYouSureDeleteOrderSpec' => 'Вы уверены, что хотите удалить специалиста из заказа?',
    'successSpecAddHours' => 'Часы успешно добавлены к заказу',
    'successApprovedOrder' => 'Успешно подтвержден заказ',
    'errorQuestionAnswer' => 'Вопрос не отвечен',
    'successOrderReviewed' => 'Ваш отзыв успешно отправлен',

    //Order Questions
    'successCreateQuestion' => 'Успешно создан вопрос',
    'successEditQuestion' => 'Успешно отредактированный вопрос',
    'successDeleteQuestion' => 'Успешно удален вопрос',

    //Order Priorities
    'successCreatePriority' => 'Приоритет успешно создан',
    'successEditPriority' => 'Приоритет успешно изменен',
    'successDeletePriority' => 'Приоритет успешно удален',

    //Returns
    'errorGetReturns' => 'Не удалось получить возврат',
    'successUpdateReturn' => 'Возврат успешно обновлен',

    //User Reviews
    'successUserReview' => 'Ваш отзыв был успешно опубликован',
    'errorUserReview' => 'Не удалось опубликовать отзыв',

    //Products
    'errorEmptyProduct' => 'Не удалось найти услугу',
    'successCreateProduct' => 'Услуга успешно создан',
    'successUpdateProduct' => 'Услуга успешно обновлен',
    'successDeleteProduct' => 'Услуга успешно удален',
    'areYouSureDeleteProduct' => 'Вы уверены, что хотите удалить эту услугу?',

    //Skills
    'errorGetSkill' => 'Не удалось найти навык',
    'successCreateSkill' => 'Навык успешно создан',
    'successUpdateSkill' => 'Навык успешно обновлен',
    'successDeleteSkill' => 'Навык успешно удален',
    'successRemoveSkill' => 'Навык успешно убран',
    'AreYouSureDeleteSkill' => 'Вы уверены, что хотите удалить этот навык?',

    //Notifications
    'successNotificationRead' => 'Уведомление успешно помечено как прочитанное',
    'successNotificationsRead' => 'Уведомления успешно помечены как прочитанные',
    'successDeleteNotification' => 'Уведомление успешно удалено',
    'successNotificationSettingTrue' => 'Уведомления теперь будут удалены после 30 дней',
    'successNotificationSettingFalse' => 'Уведомления теперь не будут удалены после 30 дней',

    //Data Export/Import
    'exportFileNotExist' => 'Файл не существует для экспорта',
    'successFileImport' => 'Файл успешно импортирован',
    'errorFileTypeIdentity' => 'Не удалось определить тип файла',
    'successImportedOrders' => 'Успешно импортированы заказы',
    'successImportedProducts' => 'Успешно импортированы товары',
    'successImportedUsers' => 'Успешно импортированы пользователи',
    'successImportedCategories' => 'Успешно импортированные категории',

    //Reports
    'successOrdersReportEmail' => 'Отчет о заказах отправлен на вашу электронную почту',
    'successUsersReportEmail' => 'Отчет о пользователях отправлен на вашу электронную почту',
    'successUserActivitiesReportEmail' => 'Отчет о действиях пользователей отправлен на вашу электронную почту',

    //Messages
    'errorMessageNotFound' => 'Сообщение не найдено',
    'errorMessageUserNotFound' => 'Пользователя сообщения не найден',
    'successSentMessage' => 'Сообщение успешно отправлено',
    'successUpdateMessage' => 'Сообщение успешно обновлено',
    'successDeleteMessage' => 'Сообщение успешно удалено',
    'successMessageRead' => 'Сообщение успешно помечено как прочитанное',
    'successMessagesRead' => 'Сообщения успешно помечены как прочитанные',
    'successMessageSettingTrue' => 'Теперь сообщения будут удаляться через 30 дней',
    'successMessageSettingFalse' => 'Сообщения теперь не будут удаляться через 30 дней',

];
