landingType = [
  {
    step: "Выберите платформу",
    href: "#calc_platform",
    id: "calc_platform",
    items: [
      {
        input: {
          id: "platform_apple",
          icon: "platform_apple",
          name: "platform",
          value: "мобильная платформа iOS"
        },
        className: "icn-apple"
      },
      {
        input: {
          id: "platform_android",
          icon: "platform_android",
          name: "platform",
          value: "мобильная платформа Android"
        },
        className: "icn-android"
      },
      {
        input: {
          id: "platform_web",
          icon: "platform_web",
          name: "platform",
          value: "веб-сайт"
        },
        className: "icn-laptop"
      }
    ]
  },
  {
    step: "Тип веб сервиса",
    id: "web_calc_type_service",
    href: "#web_calc_type_service",
    items: [
      {
        input: {
          id: "type_corp_site",
          icon: "type_corp_site",
          name: "type_site",
          value: "корпоративный сайт"
        },
        className: "icn-mobile"
      },
      {
        input: {
          id: "type_shop",
          icon: "type_shop",
          name: "type_site",
          value: "интернет-магазин"
        },
        className: "icn-tablet"
      },
      {
        input: {
          id: "type_landing",
          icon: "type_landing",
          name: "type_site",
          value: "лендинг"
        },
        className: "icn-watch"
      },
      {
        input: {
          id: "type_corp_portal",
          icon: "type_corp_portal",
          name: "type_site",
          value: "корпоративный портал"
        },
        className: "icn-watch"
      },
      {
        input: {
          id: "type_admin_panel",
          icon: "type_admin_panel",
          name: "type_site",
          value: "админ панель для сущ-го проекта"
        },
        className: "icn-watch"
      },
      {
        input: {
          id: "type_crm_system",
          icon: "type_crm_system",
          name: "type_site",
          value: "CRM/ERP-система"
        },
        className: "icn-watch"
      }
    ]
  },
  {
    step: "Дизайн",
    id: "web_calc_design",
    href: "#web_calc_design",
    items: [
      {
        input: {
          id: "web_design_native",
          icon: "design_native",
          name: "web_design",
          value: "нативные элементы"
        },
        className: "icn-layout1"
      },
      {
        input: {
          id: "web_design_middle",
          icon: "design_middle",
          name: "web_design",
          value: "свой дизайн, несложные элементы"
        },
        className: "icn-layout2"
      },
      {
        input: {
          id: "web_design_top",
          icon: "design_top",
          name: "web_design",
          value: "кастомный крутой дизайн"
        },
        className: "icn-layout3"
      }
    ]
  },
  {
    step: "Верстка",
    id: "web_calc_layout",
    href: "#web_calc_layout",
    items: [
      {
        input: {
          id: "layout_adaptive",
          icon: "layout_adaptive",
          name: "layout",
          value: "адаптивная верстка"
        },
        className: ""
      },
      {
        input: {
          id: "layout_fixed",
          icon: "layout_fixed",
          name: "layout",
          value: "без адаптивной верстки"
        },
        className: ""
      }
    ]
  },
  {
    step: "Наполнение",
    id: "web_calc_content",
    href: "#web_calc_content",
    items: [
      {
        input: {
          id: "web_content_main",
          icon: "content_main",
          name: "content_main",
          value: "главная страница"
        },
        className: "icn-news"
      },
      {
        input: {
          id: "web_content_news",
          icon: "content_news",
          name: "content_news",
          value: "лента новостей"
        },
        className: "icn-news"
      },
      {
        input: {
          id: "web_content_search",
          icon: "content_search",
          name: "content_search",
          value: "поиск, фильтрация"
        },
        className: ""
      },
      {
        input: {
          id: "web_content_catalog",
          icon: "content_catalog",
          name: "content_catalog",
          value: "каталоги, категории"
        },
        className: "icn-catalog"
      },
      {
        input: {
          id: "web_content_blog",
          icon: "content_blog",
          name: "content_blog",
          value: "блоги, статьи"
        },
        className: "icn-catalog"
      },
      {
        input: {
          id: "web_content_gallery",
          icon: "content_gallery",
          name: "web_content_gallery",
          value: "фотогалерея"
        },
        className: ""
      },
      {
        input: {
          id: "web_content_upload",
          icon: "content_upload",
          name: "content_upload",
          value: "загрузка фото, аудио, видео"
        },
        className: ""
      },
      {
        input: {
          id: "web_content_editfoto",
          icon: "content_editfoto",
          name: "content_editfoto",
          value: "редактирование фото, видео"
        },
        className: ""
      },
      {
        input: {
          id: "web_content_calendar",
          icon: "content_calendar",
          name: "content_calendar",
          value: "календарь, выбор дат"
        },
        className: ""
      },
      {
        input: {
          id: "web_content_map",
          icon: "content_map",
          name: "content_map",
          value: "карты, геолокация"
        },
        className: ""
      },
      {
        input: {
          id: "web_content_infoblog",
          icon: "content_infoblog",
          name: "content_infoblog",
          value: "инфоблоки: о компании, партнеры, FAQ, контакты"
        },
        className: "icn-catalog"
      }
    ]
  },
  {
    step: "Социальное взаимодействие ",
    id: "web_calc_society",
    href: "#web_calc_society",
    items: [
      {
        input: {
          id: "web_society_chat",
          name: "society_chat",
          icon: "society_chat",
          value: "сообщения и чаты"
        },
        className: "icn-sms"
      },
      {
        input: {
          id: "web_society_comment",
          icon: "society_comment",
          name: "society_comment",
          value: "комментарий, форум"
        },
        className: "icn-message"
      },
      {
        input: {
          id: "web_society_push",
          icon: "society_push",
          name: "society_push",
          value: "push уведомления"
        },
        className: ""
      },
      {
        input: {
          id: "web_society_back",
          icon: "web_society_back",
          name: "web_society_back",
          value: "обратная связь"
        },
        className: ""
      },
      {
        input: {
          id: "web_society_sms",
          icon: "society_sms",
          name: "society_sms",
          value: "SMS"
        },
        className: "icn-talk"
      },
      {
        input: {
          id: "web_society_email",
          icon: "society_email",
          name: "society_email",
          value: "e-mail рассылка"
        },
        className: "icn-letter"
      },
      {
        input: {
          id: "web_society_social",
          icon: "society_social",
          name: "society_social",
          value: "поделиться в соц. сетях"
        },
        className: ""
      },
      {
        input: {
          id: "web_society_forum",
          icon: "society_forum",
          name: "society_forum",
          value: "форум"
        },
        className: ""
      }
    ]
  },
  {
    step: "&nbsp;&nbsp;&nbsp;Дополнительно&nbsp;&nbsp;",
    id: "web_calc_extra",
    href: "#web_calc_extra",
    items: [
      {
        input: {
          id: "web_extra_site_map",
          icon: "extra_site_map",
          name: "extra_site_map",
          value: "карта сайта"
        },
        className: "icn-vr"
      },
      {
        input: {
          id: "web_extra_not_found_page",
          icon: "extra_not_found_page",
          name: "extra_not_found_page",
          value: "404 страница"
        },
        className: "icn-ar"
      }
    ]
  },
  {
    step: "Администрирование&nbsp;&nbsp;&nbsp;",
    id: "web_calc_administration",
    href: "#web_calc_administration",
    items: [
      {
        input: {
          id: "web_admin_payment",
          icon: "extra_online_teaching",
          name: "admin_payment",
          value: "администрирование платежей"
        },
        className: "icn-invoice"
      },
      {
        input: {
          id: "web_admin_analityc",
          icon: "admin_analityc",
          name: "admin_analityc",
          value: "аналитика использования приложения"
        },
        className: "icn-analytic"
      },
      {
        input: {
          id: "web_admin_content",
          icon: "admin_content",
          name: "admin_content",
          value: "управление контентом"
        },
        className: "icn-manage"
      },
      {
        input: {
          id: "web_admin_users",
          icon: "admin_users",
          name: "admin_users",
          value: "администрирование пользователей"
        },
        className: "icn-users"
      },
      {
        input: {
          id: "web_admin_moderation",
          icon: "admin_moderation",
          name: "admin_moderation",
          value: "модерация"
        },
        className: "icn-moderate"
      },
      {
        input: {
          id: "web_admin_feedback",
          icon: "admin_feedback",
          name: "admin_feedback",
          value: "обработка обратной связи"
        },
        className: "icn-feedback"
      },
      {
        input: {
          id: "web_admin_crash",
          icon: "admin_crash",
          name: "admin_crash",
          value: "статистика крашей"
        },
        className: "icn-statistic"
      }
    ]
  }
];
