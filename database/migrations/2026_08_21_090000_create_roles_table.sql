

CREATE TABLE IF NOT EXISTS `roles` (
    id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(50) NOT NULL UNIQUE,
    created_at DATETIME NULL,
    updated_at DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `roles` (name, created_at, updated_at)
SELECT * FROM (SELECT 'admin' AS name, NOW() AS created_at, NOW() AS updated_at) AS tmp
WHERE NOT EXISTS (SELECT 1 FROM `roles` WHERE name = 'admin');
