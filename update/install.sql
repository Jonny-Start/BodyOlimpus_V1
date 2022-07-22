CREATE TABLE IF NOT EXISTS PREFIX_admins (
  id_userAdmin int(11) NOT NULL AUTO_INCREMENT,
  id_customerAccount int(11) DEFAULT NULL,
  username varchar(255) NOT NULL,
  pass varchar(255) NOT NULL,
  code_email int(11) DEFAULT NULL,
  rol_admin tinyint(1) NOT NULL,
  ip_connect varchar(255) DEFAULT NULL,
  PRIMARY KEY (id_userAdmin)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS PREFIX_customeraccount (
  id_customerAccount int(11) NOT NULL AUTO_INCREMENT,
  firstName varchar(255) NOT NULL,
  lastName varchar(255) NOT NULL,
  identificationNumber int(11) NOT NULL,
  phoneNumber bigint(11) DEFAULT NULL,
  gymName varchar(255) DEFAULT NULL,
  locationCustomer varchar(255) DEFAULT NULL,
  accountType int(11) NOT NULL,
  availableUsers int(11) NOT NULL,
  paymentMethod varchar(255) DEFAULT NULL,
  paymentAmount varchar(255) DEFAULT NULL,
  active bit(1) NOT NULL COMMENT '1 active, 0 inactive',
  activationDate date NOT NULL,
  expirationDate date DEFAULT NULL,
  comments text,
  date_add date NOT NULL,
  date_upd date NOT NULL,
  PRIMARY KEY (id_customerAccount)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS PREFIX_user (
  id_user int(11) NOT NULL AUTO_INCREMENT,
  first_name varchar(255) DEFAULT NULL,
  last_name varchar(255) DEFAULT NULL,
  height_user varchar(255) DEFAULT NULL,
  email varchar(255) DEFAULT NULL,
  passwd varchar(255) DEFAULT NULL,
  phone_number bigint(20) DEFAULT '0' COMMENT 'Numero de teléfono ',
  gender varchar(255) DEFAULT NULL,
  actual_weight int(11) DEFAULT '0' COMMENT 'Peso actual',
  date_nac date DEFAULT NULL COMMENT 'Fecha de nacimiento',
  stateUser varchar(255) DEFAULT NULL COMMENT 'Estado de la cuenta',
  createAccount_date date DEFAULT NULL COMMENT 'fecha de inicio en el aplicativo',
  exercise_space varchar(255) DEFAULT NULL COMMENT 'Lugar de ejercicio',
  last_update date DEFAULT NULL COMMENT 'Ultima actualización en datos ',
  user_activated int(11) DEFAULT '0',
  finish_date date DEFAULT NULL COMMENT 'Fecha finalización de la mensualidad (Solo si es usuario patrocinado por GYM) ',
  last_connection date DEFAULT NULL COMMENT 'Ultima conexión del usuario al aplicativo.',
  PRIMARY KEY (id_user)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS PREFIX_weight (
  id_weight int(11) NOT NULL AUTO_INCREMENT,
  weight varchar(255) NOT NULL,
  id_user int(11) NOT NULL,
  date_weight date NOT NULL COMMENT 'fecha de este registro',
  PRIMARY KEY (id_weight)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- CREATE TABLE IF NOT EXISTS PREFIX_cms (
--   id_cms int(11) NOT NULL AUTO_INCREMENT,
--   type_content int(1) NOT NULL COMMENT '1 para ejercicio, 2 para alimentación.',
--   type_level int(1) NOT NULL COMMENT 'tipo de dificultad 1 principiante, 2 medio y 3 avanzado',
--   message_help varchar(255) NOT NULL DEFAULT 'Mensaje de ayuda no disponible para este contenido.' COMMENT 'Mensaje de ayuda para el usuario',
--   type_place int(1) DEFAULT NULL COMMENT '1 para Gym y 2 para Casa',
--   img_cms varchar(255) DEFAULT NULL,
--   video_cms varchar(255) DEFAULT NULL,
--   content_cms longtext NOT NULL COMMENT 'Texto de contenido en cms',
--   img_banner varchar(255) DEFAULT NULL,
--   PRIMARY KEY (id_cms)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- CREATE TABLE IF NOT EXISTS PREFIX_errors (
--   id_errors int(11) NOT NULL AUTO_INCREMENT,
--   id_user int(11) NOT NULL,
--   messageTitle varchar(255) NOT NULL,
--   messageBody text NOT NULL,
--   PRIMARY KEY (id_errors)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- CREATE TABLE IF NOT EXISTS PREFIX_exercise_plan (
--   id_exercise_plan int(11) NOT NULL AUTO_INCREMENT,
--   gender varchar(255) NOT NULL,
--   text_context text NOT NULL,
--   name_img varchar(255) DEFAULT NULL,
--   PRIMARY KEY (id_exercise_plan)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- CREATE TABLE IF NOT EXISTS PREFIX_nutrition_plan (
--   id_nutrition_plan int(11) NOT NULL AUTO_INCREMENT,
--   gender varchar(255) NOT NULL,
--   text_context text NOT NULL,
--   name_img varchar(255) DEFAULT NULL,
--   PRIMARY KEY (id_nutrition_plan)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;