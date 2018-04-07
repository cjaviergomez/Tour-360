--
-- PostgreSQL database dump
--

-- Dumped from database version 10.1
-- Dumped by pg_dump version 10.1

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: capa; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE capa (
    id_capa character varying(10) NOT NULL,
    nombre_capa character varying(30) NOT NULL,
    descripcion_capa character varying(150) NOT NULL,
    id_proyecto integer NOT NULL
);


ALTER TABLE capa OWNER TO postgres;

--
-- Name: imagen; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE imagen (
    id_imagen character varying(100) NOT NULL
);


ALTER TABLE imagen OWNER TO postgres;

--
-- Name: proyecto; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE proyecto (
    id_proyecto integer NOT NULL,
    nombre_proyecto character varying(20) NOT NULL,
    id_usuario character varying(20) NOT NULL,
    descripcion_proyecto character varying(200) NOT NULL
);


ALTER TABLE proyecto OWNER TO postgres;

--
-- Name: proyecto_id_proyecto_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE proyecto_id_proyecto_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE proyecto_id_proyecto_seq OWNER TO postgres;

--
-- Name: proyecto_id_proyecto_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE proyecto_id_proyecto_seq OWNED BY proyecto.id_proyecto;


--
-- Name: usuario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE usuario (
    id_usuario character varying(10) NOT NULL,
    nombre_usuario character varying(20) NOT NULL,
    password_usuario character varying(100) NOT NULL,
    id_imagen character varying(100)
);


ALTER TABLE usuario OWNER TO postgres;

--
-- Name: proyecto id_proyecto; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY proyecto ALTER COLUMN id_proyecto SET DEFAULT nextval('proyecto_id_proyecto_seq'::regclass);


--
-- Data for Name: capa; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: imagen; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO imagen VALUES ('img/tre.jpg');
INSERT INTO imagen VALUES ('img/universidad.jpg');


--
-- Data for Name: proyecto; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO proyecto VALUES (22, 'Inventario vial UIS', '2131752', 'Inventario de vías dentro de la universidad Industrial de Santander.');
INSERT INTO proyecto VALUES (23, 'Geomatica', '2131752', 'Inventario hecho por Geomatica');


--
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO usuario VALUES ('2131752', 'Carlos Gomez', '123456', 'img/tre.jpg');


--
-- Name: proyecto_id_proyecto_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('proyecto_id_proyecto_seq', 23, true);


--
-- Name: capa capa_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY capa
    ADD CONSTRAINT capa_pkey PRIMARY KEY (id_capa, id_proyecto);


--
-- Name: imagen imagen_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY imagen
    ADD CONSTRAINT imagen_pkey PRIMARY KEY (id_imagen);


--
-- Name: proyecto proyecto_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY proyecto
    ADD CONSTRAINT proyecto_pkey PRIMARY KEY (id_proyecto);


--
-- Name: usuario usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (id_usuario);


--
-- Name: capa capa_id_proyecto_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY capa
    ADD CONSTRAINT capa_id_proyecto_fkey FOREIGN KEY (id_proyecto) REFERENCES proyecto(id_proyecto) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: proyecto proyecto_id_usuario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY proyecto
    ADD CONSTRAINT proyecto_id_usuario_fkey FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: usuario usuario_id_imagen_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT usuario_id_imagen_fkey FOREIGN KEY (id_imagen) REFERENCES imagen(id_imagen) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

