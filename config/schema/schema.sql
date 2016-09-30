CREATE
    TABLE users (
        id INT NOT NULL AUTO_INCREMENT,
        id_string VARCHAR(100) NOT NULL,
        last_name VARCHAR(100) NOT NULL,
        first_name VARCHAR(100) NOT NULL,
        password VARCHAR(300) NOT NULL,
        mail VARCHAR(300),
        is_authorized TINYINT(1) DEFAULT 0,
        is_deleted TINYINT(1) DEFAULT 0,
        created_at DATETIME DEFAULT current_timestamp,
        updated_at TIMESTAMP DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
        );

CREATE
    TABLE projects (
        id INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(100) NOT NULL,
        budget INT,
        customer_name VARCHAR(100),
        started_at DATE NOT NULL,
        finished_at DATE NOT NULL,
        created_at DATETIME DEFAULT current_timestamp,
        updated_at TIMESTAMP DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
        );

CREATE
    TABLE roles (
        id INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        created_at DATETIME DEFAULT current_timestamp,
        updated_at TIMESTAMP DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
        );

CREATE
    TABLE projects_users (
        id INT NOT NULL AUTO_INCREMENT,
        project_id INT NOT NULL,
        user_id INT NOT NULL,
        role_id INT NOT NULL,
        is_deleted TINYINT(1) DEFAULT 0,
        FOREIGN KEY project_key(project_id) REFERENCES projects(id),
        FOREIGN KEY user_key(user_id) REFERENCES users(id),
        FOREIGN KEY role_key(role_id) REFERENCES roles(id),
        UNIQUE (project_id, user_id),
        PRIMARY KEY (id)
        );

CREATE
    TABLE minutes (
        id INT NOT NULL AUTO_INCREMENT,
        project_id INT NOT NULL,
        name VARCHAR(255) NOT NULL,
        holded_place VARCHAR(255),
        holded_at DATETIME,
        created_at DATETIME DEFAULT current_timestamp,
        updated_at TIMESTAMP DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
        revision TINYINT,
        is_examined TINYINT(1) DEFAULT 0,
        is_approved TINYINT(1) DEFAULT 0,
        examined_at DATETIME,
        approved_at DATETIME,
        examined_by INT,
        approved_by INT,
        examined_user_name VARCHAR(201),
        approved_user_name VARCHAR(201),
        is_deletable TINYINT(1) DEFAULT 0,
        FOREIGN KEY project_key(project_id) REFERENCES projects(id),
        FOREIGN KEY approver_by_key(approved_by) REFERENCES users(id),
        FOREIGN KEY examined_by_key(examined_by) REFERENCES users(id),
        PRIMARY KEY (id)
        );

CREATE
    TABLE participations (
        id INT NOT NULL AUTO_INCREMENT,
        projects_user_id INT NOT NULL,
        minute_id INT NOT NULL,
        state VARCHAR(10) NOT NULL,
        FOREIGN KEY projects_user_key(projects_user_id) REFERENCES projects_users(id),
        FOREIGN KEY minute_key(minute_id) REFERENCES minutes(id),
        UNIQUE (projects_user_id, minute_id),
        PRIMARY KEY (id)
        );

CREATE
    TABLE item_categories (
        id INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(50) NOT NULL,
        created_at DATETIME DEFAULT current_timestamp,
        updated_at TIMESTAMP DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
        );

CREATE
    TABLE items (
        id INT NOT NULL AUTO_INCREMENT,
        minute_id INT NOT NULL,
        primary_char VARCHAR(10) NOT NULL,
        item_category_id INT NOT NULL,
        order_in_minute TINYINT NOT NULL,
        contents VARCHAR(300),
        revision TINYINT,
        overed_at DATE,
        created_at DATETIME DEFAULT current_timestamp,
        updated_at TIMESTAMP DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY minute_key(minute_id) REFERENCES minutes(id),
        FOREIGN KEY item_category_key(item_category_id) REFERENCES item_categories(id),
        PRIMARY KEY (id)
        );

CREATE
    TABLE responsibilities (
        id INT NOT NULL AUTO_INCREMENT,
        item_id INT NOT NULL,
        projects_user_id INT NOT NULL,
        FOREIGN KEY item_key(item_id) REFERENCES items(id),
        FOREIGN KEY projects_user_key(projects_user_id) REFERENCES projects_users(id),
        UNIQUE(item_id, projects_user_id),
        PRIMARY KEY (id)
        );
