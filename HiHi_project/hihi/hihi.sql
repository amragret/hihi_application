CREATE TABLE role (
    id_role   INT AUTO_INCREMENT PRIMARY KEY,
    libelle   VARCHAR(30) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE hihi (
    id_hihi      INT AUTO_INCREMENT PRIMARY KEY,
    nom          VARCHAR(50)  NOT NULL UNIQUE,
    description  TEXT         NOT NULL,
    mythologie   TEXT,
    traits       TEXT,
    symbolique   TEXT,
    image        VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE utilisateur (
    id_utilisateur    INT AUTO_INCREMENT PRIMARY KEY,
    pseudo            VARCHAR(50)  NOT NULL UNIQUE,
    email             VARCHAR(255) NOT NULL UNIQUE CHECK (email LIKE '%_@_%._%'),
    mot_de_passe      VARCHAR(255) NOT NULL,
    language          VARCHAR(2)   NOT NULL DEFAULT 'fr' CHECK (language IN ('fr', 'en')),
    date_inscription  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_attribution  DATETIME     NULL,
    code_partage      VARCHAR(32)  NULL UNIQUE,
    id_role           INT          NOT NULL DEFAULT 1,
    id_hihi           INT          NULL,
    FOREIGN KEY (id_role) REFERENCES role(id_role),
    FOREIGN KEY (id_hihi) REFERENCES hihi(id_hihi) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE question (
    id_question  INT AUTO_INCREMENT PRIMARY KEY,
    texte        TEXT         NOT NULL,
    image        VARCHAR(255),
    ordre        INT          NOT NULL UNIQUE CHECK (ordre > 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE choix (
    id_choix     INT AUTO_INCREMENT PRIMARY KEY,
    ordre        INT          NOT NULL CHECK (ordre > 0),
    libelle      VARCHAR(255) NOT NULL,
    id_question  INT          NOT NULL,
    UNIQUE (id_question, ordre),
    FOREIGN KEY (id_question) REFERENCES question(id_question) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE calcul (
    id_calcul  INT AUTO_INCREMENT PRIMARY KEY,
    point      INT NOT NULL DEFAULT 0 CHECK (point >= 0),
    id_hihi    INT NOT NULL,
    id_choix   INT NOT NULL,
    UNIQUE (id_choix, id_hihi),
    FOREIGN KEY (id_hihi)  REFERENCES hihi(id_hihi)   ON DELETE CASCADE,
    FOREIGN KEY (id_choix) REFERENCES choix(id_choix) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE reponse (
    id_reponse      INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur  INT NOT NULL,
    id_choix        INT NOT NULL,
    UNIQUE (id_utilisateur, id_choix),
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur) ON DELETE CASCADE,
    FOREIGN KEY (id_choix)       REFERENCES choix(id_choix) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO role (id_role, libelle) VALUES
    (1, 'utilisateur'),
    (2, 'administrateur');
