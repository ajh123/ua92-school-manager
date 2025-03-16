INSERT INTO `Roles` (`id`, `permissions`, `name`) VALUES ('1', '*', 'admin');

INSERT INTO `Users` (`id`, `name`, `email`, `password`, `avatarURL`, `roleID`, `contactID`, `medicalID`) VALUES ('1', 'admin', 'admin@example.com', '$2y$10$nIla5p2URa/m/lSQu7alKOoG0slCj7smpCudAh7lGcnSktLly5Ntm', NULL, '1', NULL, NULL);