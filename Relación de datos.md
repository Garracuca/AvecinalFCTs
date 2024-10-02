CREATE TABLE Usuarios (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    rol ENUM('admin', 'empleado') NOT NULL,  -- rol define si es un empleado o un administrador
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Turnos (
    id_turno INT PRIMARY KEY AUTO_INCREMENT,
    fecha DATE NOT NULL,
    hora_inicio TIME NOT NULL,
    hora_fin TIME NOT NULL,
    tipo_turno ENUM('mañana', 'tarde', 'noche'),  -- Puedes adaptar los valores según los tipos de turnos.
    descripcion VARCHAR(255),
    UNIQUE(fecha, hora_inicio, hora_fin)  -- Evita la creación de turnos solapados en la misma fecha
);



CREATE TABLE Asignaciones (
    id_asignacion INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT,
    id_turno INT,
    estado ENUM('asignado', 'pendiente', 'cambiado') DEFAULT 'asignado',  -- Estado del turno
    fecha_asignacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario),
    FOREIGN KEY (id_turno) REFERENCES Turnos(id_turno),
    UNIQUE(id_usuario, id_turno)  -- Un empleado no puede tener el mismo turno dos veces
);


CREATE TABLE SolicitudesCambio (
    id_solicitud INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT,
    id_turno INT,
    id_turno_solicitado INT,  -- Turno al que el empleado desea cambiarse
    estado ENUM('pendiente', 'aprobado', 'rechazado') DEFAULT 'pendiente',
    fecha_solicitud TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario),
    FOREIGN KEY (id_turno) REFERENCES Turnos(id_turno),
    FOREIGN KEY (id_turno_solicitado) REFERENCES Turnos(id_turno)
);
CREATE TABLE HistorialCambios (
    id_historial INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT,
    id_turno_original INT,
    id_turno_nuevo INT,
    fecha_cambio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario),
    FOREIGN KEY (id_turno_original) REFERENCES Turnos(id_turno),
    FOREIGN KEY (id_turno_nuevo) REFERENCES Turnos(id_turno)
);
