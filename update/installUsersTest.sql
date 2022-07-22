INSERT INTO `bo_customeraccount` (`id_customerAccount`, `firstName`, `lastName`, `identificationNumber`, `phoneNumber`, `gymName`, `locationCustomer`, `accountType`, `availableUsers`, `paymentMethod`, `paymentAmount`, `active`, `activationDate`, `expirationDate`, `comments`, `date_add`, `date_upd`) VALUES
(1, 'use test', 'proof', 1000000000, 3015018468, 'BodyOlimpus', 'Bogotá D.C (Colombia)', 1, 0, NULL, NULL, 1, LOCALTIME(), NULL, 'Super Admin ', LOCALTIME(), LOCALTIME());

INSERT INTO `bo_admins` (`id_userAdmin`, `id_customerAccount`, `username`, `pass`, `code_email`, `rol_admin`) VALUES
(1, 1, 'user test', '$2y$10$tYc5x2dfdPqQxpFp.BVC9.HkCEGQLDCFWrU/RIdI.LkImxCfgh9ue', NULL, 1);

INSERT INTO `bo_user` (`id_user`, `first_name`, `last_name`, `height_user`, `email`, `passwd`, `phone_number`, `gender`, `actual_weight`, `date_nac`, `stateUser`, `createAccount_date`, `exercise_space`, `last_update`, `user_activated`, `finish_date`, `last_connection`) VALUES
(1, 'user test', 'proof', '1.66', 'bodyolimpus@gmail.com', '$2y$10$tYc5x2dfdPqQxpFp.BVC9.HkCEGQLDCFWrU/RIdI.LkImxCfgh9ue', 3015018468, 'Indefinido', 80, '2001-10-02', NULL, '2021-10-28', 'Gym', '2021-11-23', 0, NULL, NULL);