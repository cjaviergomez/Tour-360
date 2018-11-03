--
-- PostgreSQL database dump
--

-- Dumped from database version 10.4
-- Dumped by pg_dump version 10.4

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
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


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: capa; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.capa (
    id_capa character varying(10) NOT NULL,
    nombre_capa character varying(30) NOT NULL,
    descripcion_capa character varying(150) NOT NULL,
    id_proyecto integer NOT NULL,
    json_capa json
);


ALTER TABLE public.capa OWNER TO postgres;

--
-- Name: imagen; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.imagen (
    id_imagen character varying(100) NOT NULL
);


ALTER TABLE public.imagen OWNER TO postgres;

--
-- Name: proyecto; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.proyecto (
    id_proyecto integer NOT NULL,
    nombre_proyecto character varying(20) NOT NULL,
    id_usuario character varying(20) NOT NULL,
    descripcion_proyecto character varying(200) NOT NULL
);


ALTER TABLE public.proyecto OWNER TO postgres;

--
-- Name: proyecto_id_proyecto_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.proyecto_id_proyecto_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.proyecto_id_proyecto_seq OWNER TO postgres;

--
-- Name: proyecto_id_proyecto_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.proyecto_id_proyecto_seq OWNED BY public.proyecto.id_proyecto;


--
-- Name: usuario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuario (
    id_usuario character varying(10) NOT NULL,
    nombre_usuario character varying(20) NOT NULL,
    password_usuario character varying(100) NOT NULL,
    id_imagen character varying(100)
);


ALTER TABLE public.usuario OWNER TO postgres;

--
-- Name: proyecto id_proyecto; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.proyecto ALTER COLUMN id_proyecto SET DEFAULT nextval('public.proyecto_id_proyecto_seq'::regclass);


--
-- Data for Name: capa; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.capa VALUES ('cap:1', 'Alcantarilla', 'Nothing', 26, '[{"type":"Point","properties":{"id":"Point:1","nombre":"Alcantarilla Uno","severidad":"Alta","dimensionamiento":"Cumple","visibilidad":"Mala","descripcion":"En malas condiciones.","latitud":7.1397455942092,"longitud":-73.12008149921894}},{"type":"Point","properties":{"id":"Point:2","nombre":"Alcantarilla dos","severidad":"Alta","dimensionamiento":"Cumple","visibilidad":"Buena","descripcion":"Perfecto estado.","latitud":7.139019028414684,"longitud":-73.12199123203754}},{"type":"LineString","properties":{"id":"LineString:1","nombre":"Polilinea 1","descripcion":"Prueba 1","coordenadas":[{"lat":7.1394145800187365,"lng":-73.11945922672749},{"lat":7.139744595109103,"lng":-73.11839707195759},{"lat":7.139137792985179,"lng":-73.11869747936726},{"lat":7.1394145800187365,"lng":-73.11945922672749}],"infoWCoord":[7.139427887032939,-73.11900325119495]}},{"type":"LineString","properties":{"id":"LineString:2","nombre":"Linea 1","descripcion":"Linea de prueba","coordenadas":[{"lat":7.1388466446538095,"lng":-73.12052023842409},{"lat":7.138963746955287,"lng":-73.11980677082613}],"infoWCoord":[7.138905195804549,-73.12016350462511]}}]');


--
-- Data for Name: imagen; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.imagen VALUES ('img/tre.jpg');
INSERT INTO public.imagen VALUES ('img/universidad.jpg');
INSERT INTO public.imagen VALUES ('img/fotohojavida.jpg');
INSERT INTO public.imagen VALUES ('img/avatar.png');
INSERT INTO public.imagen VALUES ('img/UISlogo.png');


--
-- Data for Name: proyecto; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.proyecto VALUES (26, 'Inventario vial UIS', '2131752', 'Inventario de vías dentro de la universidad Industrial de Santander.');


--
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.usuario VALUES ('2131752', 'Carlos Gomez', '1234567', 'img/UISlogo.png');


--
-- Name: proyecto_id_proyecto_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.proyecto_id_proyecto_seq', 26, true);


--
-- Name: capa capa_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.capa
    ADD CONSTRAINT capa_pkey PRIMARY KEY (id_capa, id_proyecto);


--
-- Name: imagen imagen_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.imagen
    ADD CONSTRAINT imagen_pkey PRIMARY KEY (id_imagen);


--
-- Name: proyecto proyecto_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.proyecto
    ADD CONSTRAINT proyecto_pkey PRIMARY KEY (id_proyecto);


--
-- Name: usuario usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (id_usuario);


--
-- Name: capa capa_id_proyecto_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.capa
    ADD CONSTRAINT capa_id_proyecto_fkey FOREIGN KEY (id_proyecto) REFERENCES public.proyecto(id_proyecto) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: proyecto proyecto_id_usuario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.proyecto
    ADD CONSTRAINT proyecto_id_usuario_fkey FOREIGN KEY (id_usuario) REFERENCES public.usuario(id_usuario) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: usuario usuario_id_imagen_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_id_imagen_fkey FOREIGN KEY (id_imagen) REFERENCES public.imagen(id_imagen) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

