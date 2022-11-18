--
-- PostgreSQL database dump
--

-- Dumped from database version 13.2
-- Dumped by pg_dump version 13.2

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: clients; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.clients (
    fname text,
    lname text,
    email text,
    mobilenum numeric,
    clientname text,
    payercode text,
    id integer NOT NULL
);


ALTER TABLE public.clients OWNER TO postgres;

--
-- Name: clients_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.clients_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.clients_id_seq OWNER TO postgres;

--
-- Name: clients_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.clients_id_seq OWNED BY public.clients.id;


--
-- Name: collection; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.collection (
    id integer NOT NULL,
    month text,
    classification text,
    account text,
    bu text,
    profit_center text,
    payer_code text,
    client_name text,
    bucket text,
    total_outstanding text,
    original_estimate text,
    revised_estimate text,
    actual_collection_f_a text,
    am_estimate text,
    assumptions text
);


ALTER TABLE public.collection OWNER TO postgres;

--
-- Name: collection_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.collection_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.collection_id_seq OWNER TO postgres;

--
-- Name: collection_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.collection_id_seq OWNED BY public.collection.id;


--
-- Name: sap_dump; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sap_dump (
    acc_doc_no text,
    assignment_no text,
    account_cd text,
    sold_to_party text,
    sold_to_name text,
    billing_date text,
    credit_period text,
    currency text,
    total_outstanding text,
    total_invoice_value text,
    within_credit_period text,
    days_upto_30 text,
    days_31_60 text,
    days_61_90 text,
    days_91_120 text,
    days_121_150 text,
    days_151_180 text,
    days_181_365 text,
    days_above_365 text,
    due_days text,
    remarks text,
    invoice_or_odn_no text,
    sap_ref_no text,
    profit_center text
);


ALTER TABLE public.sap_dump OWNER TO postgres;

--
-- Name: static_master; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.static_master (
    id integer NOT NULL,
    category text,
    bu text,
    region text,
    services text,
    acc_type text,
    ec_nc text,
    profit_center text
);


ALTER TABLE public.static_master OWNER TO postgres;

--
-- Name: static_master_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.static_master_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.static_master_id_seq OWNER TO postgres;

--
-- Name: static_master_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.static_master_id_seq OWNED BY public.static_master.id;


--
-- Name: user_account; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.user_account (
    id integer NOT NULL,
    fname text,
    lname text,
    email text,
    password text,
    mnumber numeric,
    desgnation text,
    accounttype text,
    region text,
    bu text,
    category text,
    department text,
    isnew numeric DEFAULT 1,
    last_login text,
    created_date text,
    last_updated_date text
);


ALTER TABLE public.user_account OWNER TO postgres;

--
-- Name: user_account_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.user_account_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_account_id_seq OWNER TO postgres;

--
-- Name: user_account_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.user_account_id_seq OWNED BY public.user_account.id;


--
-- Name: clients id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.clients ALTER COLUMN id SET DEFAULT nextval('public.clients_id_seq'::regclass);


--
-- Name: collection id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.collection ALTER COLUMN id SET DEFAULT nextval('public.collection_id_seq'::regclass);


--
-- Name: static_master id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.static_master ALTER COLUMN id SET DEFAULT nextval('public.static_master_id_seq'::regclass);


--
-- Name: user_account id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_account ALTER COLUMN id SET DEFAULT nextval('public.user_account_id_seq'::regclass);


--
-- Data for Name: clients; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: collection; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.collection VALUES (5, 'Jan/21', 'CHIPs', 'RM-East', 'EPS', '70002', '1109822', 'Client_87', 'WITHIN CR PD', '0.217002575', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (6, 'Jan/21', 'CIL & Subsidiaries', 'RM-West', 'Value', '84128', '1107396', 'Client_550', 'DAYS ABOVE 180', '-0.112214734', '-0.18169075', '-0.207733832', '0', '-0.207995287', 'Remarks from AM');
INSERT INTO public.collection VALUES (7, 'Jan/21', 'CIL & Subsidiaries', 'RM-West', 'Value', '84128', '1107396', 'Client_550', 'DAYS UPTO 60', '-0.080632236', '0.014833402', '-0.034790397', '0', '-0.035250012', 'Remarks from AM');
INSERT INTO public.collection VALUES (8, 'Jan/21', 'CIL & Subsidiaries', 'SP', 'Coal', '20100', '1100000', 'Client_49', 'DAYS 61-90', '0.284234312', '2.285239245', '1.963191947', '0', '1.960443026', 'Remarks from AM');
INSERT INTO public.collection VALUES (9, 'Jan/21', 'CIL & Subsidiaries', 'SP', 'Coal', '20100', '1100000', 'Client_49', 'DAYS UPTO 60', '1.870484016', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (10, 'Jan/21', 'CIL & Subsidiaries', 'SP', 'Coal', '20100', '1100000', 'Client_49', 'WITHIN CR PD', '0.680796738', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (11, 'Jan/21', 'CIL & Subsidiaries', 'SP', 'Coal', '20200', '1100001', 'Client_103', 'ADVANCE', '-0.11236125', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (12, 'Jan/21', 'CIL & Subsidiaries', 'SP', 'Coal', '20200', '1100001', 'Client_103', 'DAYS UPTO 60', '3.544858703', '-0.182396262', '6.306285221', '0', '6.298559947', 'Remarks from AM');
INSERT INTO public.collection VALUES (13, 'Jan/21', 'CIL & Subsidiaries', 'SP', 'Coal', '20200', '1100001', 'Client_103', 'WITHIN CR PD', '0.680796738', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (14, 'Jan/21', 'CIL & Subsidiaries', 'SP', 'Coal', '20300', '1100002', 'Client_443', 'DAYS UPTO 60', '1.30688469', '-0.182396262', '1.963191947', '0', '1.960443026', 'Remarks from AM');
INSERT INTO public.collection VALUES (15, 'Jan/21', 'CIL & Subsidiaries', 'SP', 'Coal', '20300', '1100002', 'Client_443', 'WITHIN CR PD', '0.792955807', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (16, 'Jan/21', 'CIL & Subsidiaries', 'SP', 'Coal', '20300', '1111402', 'Client_443', 'WITHIN CR PD', '-0.02420313', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (17, 'Jan/21', 'CIL & Subsidiaries', 'SP', 'Coal', '20300', '1111403', 'Client_443', 'DAYS UPTO 60', '0.451271211', '-0.182396262', '1.963191947', '0', '1.960443026', 'Remarks from AM');
INSERT INTO public.collection VALUES (18, 'Jan/21', 'CIL & Subsidiaries', 'SP', 'Coal', '20300', '1111403', 'Client_443', 'WITHIN CR PD', '0.08395026', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (19, 'Jan/21', 'CIL & Subsidiaries', 'SP', 'Coal', '20500', '1100004', 'Client_214', 'DAYS UPTO 60', '1.47392159', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (20, 'Jan/21', 'CIL & Subsidiaries', 'SP', 'Coal', '20500', '1100004', 'Client_214', 'WITHIN CR PD', '1.077359164', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (21, 'Jan/21', 'CIL & Subsidiaries', 'SP', 'Coal', '20600', '1100005', 'Client_248', 'DAYS UPTO 60', '1.077359164', '-0.182396262', '4.134738584', '0', '4.129501487', 'Remarks from AM');
INSERT INTO public.collection VALUES (22, 'Jan/21', 'CIL & Subsidiaries', 'SP', 'Coal', '20600', '1100005', 'Client_248', 'WITHIN CR PD', '0.680796738', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (23, 'Jan/21', 'CIL & Subsidiaries', 'SP', 'Coal', '20610', '1106716', 'Client_83', 'DAYS  91-150', '1.870484016', '7.220510259', '10.6493785', '0', '10.63667687', 'Remarks from AM');
INSERT INTO public.collection VALUES (24, 'Jan/21', 'CIL & Subsidiaries', 'SP', 'Coal', '20610', '1106716', 'Client_83', 'DAYS 61-90', '0.680796738', '-0.182396262', '1.963191947', '0', '1.960443026', 'Remarks from AM');
INSERT INTO public.collection VALUES (25, 'Jan/21', 'CIL & Subsidiaries', 'SP', 'Coal', '20610', '1106716', 'Client_83', 'DAYS UPTO 60', '2.575483884', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (26, 'Jan/21', 'CIL & Subsidiaries', 'SP', 'Coal', '20610', '1106716', 'Client_83', 'WITHIN CR PD', '1.077359164', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (27, 'Jan/21', 'CIL & Subsidiaries', 'SP', 'Coal', '20620', '1106166', 'Client_550', 'ADVANCE', '-0.112381628', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (28, 'Jan/21', 'CIL & Subsidiaries', 'SP', 'Coal', '20620', '1106166', 'Client_550', 'DAYS 61-90', '0.284234312', '2.285239245', '1.963191947', '0', '1.960443026', 'Remarks from AM');
INSERT INTO public.collection VALUES (29, 'Jan/21', 'CIL & Subsidiaries', 'SP', 'Coal', '20620', '1106166', 'Client_550', 'DAYS UPTO 60', '1.077359164', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (30, 'Jan/21', 'CIL & Subsidiaries', 'SP', 'Coal', '20620', '1106166', 'Client_550', 'WITHIN CR PD', '0.284234312', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (31, 'Jan/21', 'CIL & Subsidiaries', 'SP', 'Content', '40004', '1009574', 'Client_248', 'ADVANCE', '-0.112454688', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (32, 'Jan/21', 'CIL & Subsidiaries', 'SP', 'Content', '40004', '1009574', 'Client_248', 'DAYS 151-180', '-0.111525399', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (33, 'Jan/21', 'CIL & Subsidiaries', 'SP', 'Content', '40004', '1009574', 'Client_248', 'DAYS ABOVE 180', '-0.103498253', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (34, 'Jan/21', 'CIL & Subsidiaries', 'SP', 'Content', '40004', '1010234', 'Client_214', 'WITHIN CR PD', '-0.101714448', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (35, 'Jan/21', 'CIL & Subsidiaries', 'SP', 'Content', '40004', '1109792', 'Client_89', 'DAYS UPTO 60', '-0.108046969', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (36, 'Jan/21', 'CIL & Subsidiaries', 'SP', 'Content', '40004', '1109792', 'Client_89', 'WITHIN CR PD', '-0.090922391', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (37, 'Jan/21', 'CIL & Subsidiaries', 'SP', 'Content', '40004', '1110363', 'Client_84', 'DAYS  91-150', '-0.111257828', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (38, 'Jan/21', 'CIL & Subsidiaries', 'SP', 'Content', '40004', '1110363', 'Client_84', 'DAYS 151-180', '-0.111792971', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (39, 'Jan/21', 'CIL & Subsidiaries', 'SP', 'Content', '40004', '1110363', 'Client_84', 'DAYS 61-90', '-0.111792971', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (40, 'Jan/21', 'CIL & Subsidiaries', 'SP', 'Content', '40004', '1110363', 'Client_84', 'DAYS ABOVE 180', '-0.110722685', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (41, 'Jan/21', 'CIL & Subsidiaries', 'SP', 'Content', '40004', '1110363', 'Client_84', 'DAYS UPTO 60', '-0.111257828', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (42, 'Jan/21', 'CIL & Subsidiaries', 'SP', 'Content', '40004', '1110363', 'Client_84', 'WITHIN CR PD', '-0.110722685', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (43, 'Jan/21', 'Foreign', 'IS', 'EPS', '53268', '3000170', 'Client_548', 'DAYS  91-150', '-0.073620177', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (44, 'Jan/21', 'Foreign', 'IS', 'EPS', '53268', '3000170', 'Client_548', 'DAYS ABOVE 180', '-0.083157702', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (45, 'Jan/21', 'Foreign', 'IS', 'EPS', '53268', '3000170', 'Client_548', 'WITHIN CR PD', '-0.074597958', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (46, 'Jan/21', 'Foreign', 'IS', 'TP', '83000', '3000015', 'Client_60', 'DAYS UPTO 60', '0.547965715', '3.926324748', '3.407365406', '0', '3.402961739', 'Remarks from AM');
INSERT INTO public.collection VALUES (47, 'Jan/21', 'Foreign', 'IS', 'TP', '83001', '3000001', 'Client_243', 'DAYS UPTO 60', '0.475549974', '1.68458325', '1.434608004', '0', '1.432464739', 'Remarks from AM');
INSERT INTO public.collection VALUES (1254, '1', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO public.collection VALUES (4, 'Jan/21', 'CHIPs', 'RM-East', 'EPS', '70002', '1109822', 'Client_87', 'DAYS UPTO 60', '0.145321656', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (2, 'Jan/21', 'CHIPs', 'RM-East', 'EPS', '70002', '1109822', 'Client_87', 'DAYS 61-90', '0.256213364', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (48, 'Jan/21', 'Foreign', 'IS', 'TP', '83001', '3000001', 'Client_243', 'WITHIN CR PD', '0.204967691', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (49, 'Jan/21', 'Foreign', 'IS', 'Value', '84275', '3000160', 'Client_513', 'DAYS 61-90', '-0.075603481', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (50, 'Jan/21', 'Foreign', 'IS', 'Value', '84275', '3000160', 'Client_513', 'DAYS UPTO 60', '0.298620897', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (51, 'Jan/21', 'Foreign', 'IS', 'Value', '84275', '3000160', 'Client_513', 'WITHIN CR PD', '0.038195212', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (52, 'Jan/21', 'Foreign', 'RM-North', 'Metal', '14312', '1112546', 'Client_518', 'DAYS UPTO 60', '-0.103296887', '-0.126198867', '-0.158900359', '0', '-0.159217768', 'Remarks from AM');
INSERT INTO public.collection VALUES (53, 'Jan/21', 'Foreign', 'SP', 'Content', '40012', '1110002', 'Client_289', 'ADVANCE', '-0.112857165', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (54, 'Jan/21', 'Foreign', 'SP', 'Content', '40012', '1110125', 'Client_417', 'ADVANCE', '-0.11280995', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (55, 'Jan/21', 'Foreign', 'SP', 'Content', '40012', '3000072', 'Client_551', 'ADVANCE', '-0.117149817', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (56, 'Jan/21', 'Foreign', 'SP', 'Content', '40012', '3000211', 'Client_106', 'DAYS ABOVE 180', '-0.094604346', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (57, 'Jan/21', 'Foreign', 'SP', 'OVC', '50037', '3000215', 'Client_461', 'WITHIN CR PD', '-0.057737295', '0.15729866', '0.090580612', '0', '0.089977346', 'Remarks from AM');
INSERT INTO public.collection VALUES (58, 'Jan/21', 'Foreign', 'SP', 'OVC', '83119', '3000081', 'Client_452', 'WITHIN CR PD', '0.037334837', '0.74889119', '0.611188605', '0', '0.609988821', 'Remarks from AM');
INSERT INTO public.collection VALUES (59, 'Jan/21', 'Foreign', 'SP', 'OVC', '83119', '3000097', 'Client_452', 'WITHIN CR PD', '0.037334837', '0.74889119', '0.611188605', '0', '0.609988821', 'Remarks from AM');
INSERT INTO public.collection VALUES (60, 'Jan/21', 'Foreign', 'SP', 'RA/AS', '50027', '3000181', 'Client_472', 'DAYS  91-150', '-0.08072964', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (61, 'Jan/21', 'Foreign', 'SP', 'RA/AS', '50027', '3000181', 'Client_472', 'DAYS UPTO 60', '-0.080581128', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (62, 'Jan/21', 'Others', 'ADMIN', 'ADMIN', '85101', '1112177', 'Client_88', 'DAYS UPTO 60', '0.120337063', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (63, 'Jan/21', 'Others', 'EAM-T', 'RA/AS', '50112', '1112970', 'Client_512', 'DAYS UPTO 60', '-0.074439984', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (64, 'Jan/21', 'Others', 'EAM-T', 'RA/AS', '50112', '1112970', 'Client_512', 'WITHIN CR PD', '-0.074439984', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (65, 'Jan/21', 'Others', 'EAM-T', 'Value', '84115', '1100254', 'Client_471', 'DAYS UPTO 60', '-0.106226299', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (66, 'Jan/21', 'Others', 'FnA', 'FnA Other Income', '85001', '1109768', 'Client_158', 'DAYS  91-150', '0.392846951', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (67, 'Jan/21', 'Others', 'FnA', 'FnA Other Income', '85001', '1109768', 'Client_158', 'DAYS 61-90', '0.140259419', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (68, 'Jan/21', 'Others', 'FnA', 'FnA Other Income', '85001', '1109768', 'Client_158', 'DAYS UPTO 60', '0.392846951', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (69, 'Jan/21', 'Others', 'Legal', 'Conference', '40007', '1111986', 'Client_244', 'ADVANCE', '-0.123030975', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (70, 'Jan/21', 'Others', 'Legal', 'Conference', '40007', '1111986', 'Client_244', 'DAYS ABOVE 180', '-0.080219529', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (71, 'Jan/21', 'Others', 'Legal', 'Content', '40002', '1108706', 'Client_237', 'DAYS ABOVE 180', '-0.088781818', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (72, 'Jan/21', 'Others', 'Legal', 'RA/AS', '53938', '1007828', 'Client_297', 'DAYS ABOVE 180', '-0.072776571', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (73, 'Jan/21', 'Others', 'NCLT', 'EPS', '53251', '1109821', 'Client_138', 'DAYS ABOVE 180', '0.264138619', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (74, 'Jan/21', 'Others', 'NCLT', 'RA/AS', '53918', '1106828', 'Client_221', 'DAYS ABOVE 180', '1.191885947', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (75, 'Jan/21', 'Others', 'RM-East', 'EPS', '50225', '1106286', 'Client_123', 'ADVANCE', '-0.11285477', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (76, 'Jan/21', 'Others', 'RM-East', 'EPS', '50237', '1107861', 'Client_252', 'DAYS UPTO 60', '0.552355978', '-0.182396262', '3.431406441', '0', '3.426975227', 'Remarks from AM');
INSERT INTO public.collection VALUES (77, 'Jan/21', 'Others', 'RM-East', 'EPS', '50237', '1107861', 'Client_252', 'WITHIN CR PD', '6.653986705', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (78, 'Jan/21', 'Others', 'RM-East', 'EPS', '50252', '1112984', 'Client_177', 'DAYS UPTO 60', '0.10207696', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (79, 'Jan/21', 'Others', 'RM-East', 'EPS', '53256', '1110562', 'Client_256', 'ADVANCE', '-0.113490517', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (80, 'Jan/21', 'Others', 'RM-East', 'EPS', '53256', '1110564', 'Client_264', 'DAYS 61-90', '-0.111215016', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (81, 'Jan/21', 'Others', 'RM-East', 'EPS', '53256', '1110564', 'Client_264', 'DAYS UPTO 60', '-0.10858022', '-0.182396262', '-0.187832485', '0', '-0.188116743', 'Remarks from AM');
INSERT INTO public.collection VALUES (82, 'Jan/21', 'Others', 'RM-East', 'EPS', '53256', '1110564', 'Client_264', 'WITHIN CR PD', '-0.104457613', '-0.182396262', '-0.165256405', '0', '-0.165566531', 'Remarks from AM');
INSERT INTO public.collection VALUES (83, 'Jan/21', 'Others', 'RM-East', 'EPS', '53256', '1110566', 'Client_254', 'DAYS UPTO 60', '-0.097336539', '-0.182396262', '-0.126261929', '0', '-0.126616735', 'Remarks from AM');
INSERT INTO public.collection VALUES (84, 'Jan/21', 'Others', 'RM-East', 'EPS', '53256', '1110566', 'Client_254', 'WITHIN CR PD', '-0.097336539', '-0.182396262', '-0.126261929', '0', '-0.126616735', 'Remarks from AM');
INSERT INTO public.collection VALUES (85, 'Jan/21', 'Others', 'RM-East', 'EPS', '53263', '1111421', 'Client_265', 'DAYS  91-150', '-0.097172862', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (86, 'Jan/21', 'Others', 'RM-East', 'EPS', '53263', '1111421', 'Client_265', 'DAYS 61-90', '-0.097172862', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (87, 'Jan/21', 'Others', 'RM-East', 'EPS', '53263', '1111421', 'Client_265', 'DAYS UPTO 60', '-0.08201761', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (88, 'Jan/21', 'Others', 'RM-East', 'EPS', '53263', '1111421', 'Client_265', 'WITHIN CR PD', '-0.097172862', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (89, 'Jan/21', 'Others', 'RM-East', 'EPS', '53267', '1112147', 'Client_62', 'WITHIN CR PD', '-0.106013426', '-0.182396262', '-0.173775922', '0', '-0.174076287', 'Remarks from AM');
INSERT INTO public.collection VALUES (90, 'Jan/21', 'Others', 'RM-East', 'EPS', '53271', '1112946', 'Client_65', 'DAYS 151-180', '0.477463774', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (91, 'Jan/21', 'Others', 'RM-East', 'Metal', '10004', '1203858', 'Client_64', 'DAYS  91-150', '-0.107276363', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (92, 'Jan/21', 'Others', 'RM-East', 'Metal', '14310', '1110372', 'Client_176', 'DAYS UPTO 60', '0.234286174', '-0.182396262', '1.689679623', '0', '1.687244095', 'Remarks from AM');
INSERT INTO public.collection VALUES (93, 'Jan/21', 'Others', 'RM-East', 'Metal', '14310', '1110372', 'Client_176', 'WITHIN CR PD', '0.090117011', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (94, 'Jan/21', 'Others', 'RM-East', 'Metal', '14343', '1112165', 'Client_245', 'DAYS ABOVE 180', '-0.094838549', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (95, 'Jan/21', 'Others', 'RM-East', 'Metal', '14350', '1112428', 'Client_78', 'ADVANCE', '-0.4569183', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1255, '1', '2', '3', '4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO public.collection VALUES (96, 'Jan/21', 'Others', 'RM-East', 'Metal', '14350', '1112428', 'Client_78', 'DAYS UPTO 60', '0.694306879', '-0.182396262', '1.678595792', '0', '1.676172964', 'Remarks from AM');
INSERT INTO public.collection VALUES (97, 'Jan/21', 'Others', 'RM-East', 'Metal', '14350', '1112428', 'Client_78', 'WITHIN CR PD', '0.297552773', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (98, 'Jan/21', 'Others', 'RM-East', 'RA/AS', '53928', '1110587', 'Client_245', 'DAYS ABOVE 180', '-0.090352998', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (99, 'Jan/21', 'Others', 'RM-East', 'RA/AS', '53932', '1107661', 'Client_273', 'DAYS UPTO 60', '-0.011293101', '0.446300682', '0.344905599', '0', '0.344010925', 'Remarks from AM');
INSERT INTO public.collection VALUES (100, 'Jan/21', 'Others', 'RM-East', 'RA/AS', '53932', '1107661', 'Client_273', 'WITHIN CR PD', '-0.061810607', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (101, 'Jan/21', 'Others', 'RM-East', 'RA/AS', '53965', '1110565', 'Client_257', 'DAYS UPTO 60', '-0.099835134', '-0.182396262', '-0.139944056', '0', '-0.140283185', 'Remarks from AM');
INSERT INTO public.collection VALUES (102, 'Jan/21', 'Others', 'RM-East', 'StraightLine', '61088', '1109644', 'Client_250', 'ADVANCE', '-29.6755051', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (103, 'Jan/21', 'Others', 'RM-East', 'StraightLine', '61088', '1109644', 'Client_250', 'DAYS 61-90', '1.174661526', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (104, 'Jan/21', 'Others', 'RM-East', 'StraightLine', '61088', '1109644', 'Client_250', 'DAYS UPTO 60', '3.227966369', '20.60280357', '18.08285188', '0', '18.06163291', 'Remarks from AM');
INSERT INTO public.collection VALUES (105, 'Jan/21', 'Others', 'RM-East', 'StraightLine', '61088', '1109644', 'Client_250', 'WITHIN CR PD', '11.20835203', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (106, 'Jan/21', 'Others', 'RM-East', 'StraightLine', '61088', '1111663', 'Client_236', 'DAYS  91-150', '-0.090182181', '-0.044591753', '-0.087085192', '0', '-0.087484888', 'Remarks from AM');
INSERT INTO public.collection VALUES (107, 'Jan/21', 'Others', 'RM-East', 'StraightLine', '61088', '1111664', 'Client_236', 'DAYS  91-150', '-0.089492274', '-0.040298765', '-0.083307315', '0', '-0.083711339', 'Remarks from AM');
INSERT INTO public.collection VALUES (108, 'Jan/21', 'Others', 'RM-East', 'StraightLine', '61088', '1111665', 'Client_236', 'DAYS 61-90', '-0.100909231', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (109, 'Jan/21', 'Others', 'RM-East', 'StraightLine', '61088', '1111665', 'Client_236', 'DAYS UPTO 60', '-0.084927506', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (110, 'Jan/21', 'Others', 'RM-East', 'StraightLine', '61088', '1111666', 'Client_236', 'WITHIN CR PD', '-0.098627809', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (111, 'Jan/21', 'Others', 'RM-East', 'StraightLine', '61088', '1111673', 'Client_236', 'DAYS 61-90', '-0.089494201', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (112, 'Jan/21', 'Others', 'RM-East', 'StraightLine', '61088', '1111673', 'Client_236', 'DAYS UPTO 60', '-0.071227199', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (113, 'Jan/21', 'Others', 'RM-East', 'StraightLine', '61088', '1112146', 'Client_250', 'DAYS  91-150', '-0.078179915', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (114, 'Jan/21', 'Others', 'RM-East', 'StraightLine', '61088', '1112146', 'Client_250', 'DAYS 61-90', '0.080396173', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (115, 'Jan/21', 'Others', 'RM-East', 'StraightLine', '61088', '1112146', 'Client_250', 'DAYS UPTO 60', '0.275375524', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (116, 'Jan/21', 'Others', 'RM-East', 'StraightLine', '61088', '1112146', 'Client_250', 'WITHIN CR PD', '0.080396173', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (117, 'Jan/21', 'Others', 'RM-East', 'StraightLine', '61133', '1111245', 'Client_94', 'DAYS  91-150', '-0.025718375', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (118, 'Jan/21', 'Others', 'RM-East', 'StraightLine', '61133', '1111245', 'Client_94', 'DAYS 61-90', '0.343357934', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (119, 'Jan/21', 'Others', 'RM-East', 'StraightLine', '61133', '1111245', 'Client_94', 'DAYS UPTO 60', '-0.068966451', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (120, 'Jan/21', 'Others', 'RM-East', 'StraightLine', '61133', '1111245', 'Client_94', 'WITHIN CR PD', '0.028219073', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (121, 'Jan/21', 'Others', 'RM-East', 'StraightLine', '61133', '1112783', 'Client_94', 'DAYS UPTO 60', '0.116048013', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (122, 'Jan/21', 'Others', 'RM-East', 'StraightLine', '61133', '1112783', 'Client_94', 'WITHIN CR PD', '-0.097832115', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (123, 'Jan/21', 'Others', 'RM-East', 'StraightLine', '61133', '1112784', 'Client_94', 'DAYS  91-150', '-0.029300319', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (124, 'Jan/21', 'Others', 'RM-East', 'StraightLine', '61133', '1112784', 'Client_94', 'DAYS UPTO 60', '0.167868998', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (125, 'Jan/21', 'Others', 'RM-East', 'StraightLine', '61133', '1112784', 'Client_94', 'WITHIN CR PD', '-0.091492926', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (126, 'Jan/21', 'Others', 'RM-East', 'StraightLine', '61133', '1112785', 'Client_94', 'DAYS  91-150', '-0.058242051', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (127, 'Jan/21', 'Others', 'RM-East', 'StraightLine', '61133', '1112785', 'Client_94', 'DAYS UPTO 60', '-0.032209725', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (128, 'Jan/21', 'Others', 'RM-East', 'StraightLine', '61133', '1112785', 'Client_94', 'WITHIN CR PD', '0.27009748', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (129, 'Jan/21', 'Others', 'RM-East', 'Value', '84010', '1112677', 'Client_200', 'DAYS 61-90', '-0.074844124', '0.050850304', '-0.003095123', '0', '-0.003591055', 'Remarks from AM');
INSERT INTO public.collection VALUES (130, 'Jan/21', 'Others', 'RM-East', 'Value', '84139', '1109401', 'Client_549', 'DAYS UPTO 60', '0.043918871', '-0.182396262', '0.509305218', '0', '0.508222174', 'Remarks from AM');
INSERT INTO public.collection VALUES (131, 'Jan/21', 'Others', 'RM-East', 'Value', '84139', '1109401', 'Client_549', 'WITHIN CR PD', '0.067036023', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (132, 'Jan/21', 'Others', 'RM-East', 'Value', '84209', '1010008', 'Client_176', 'DAYS UPTO 60', '-0.105170793', '-0.182396262', '-0.169161731', '0', '-0.169467383', 'Remarks from AM');
INSERT INTO public.collection VALUES (133, 'Jan/21', 'Others', 'RM-East', 'Value', '84210', '1107504', 'Client_547', 'DAYS 151-180', '-0.105648184', '-0.182396262', '-0.171775886', '0', '-0.172078542', 'Remarks from AM');
INSERT INTO public.collection VALUES (134, 'Jan/21', 'Others', 'RM-East', 'Value', '84266', '1111830', 'Client_245', 'DAYS ABOVE 180', '-0.048640768', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (135, 'Jan/21', 'Others', 'RM-East', 'Value', '84270', '1112817', 'Client_233', 'DAYS UPTO 60', '-0.049760125', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (136, 'Jan/21', 'Others', 'RM-East', 'Value', '84270', '1112820', 'Client_227', 'DAYS UPTO 60', '-0.0660842', '-0.182396262', '0.044873576', '0', '0.044322681', 'Remarks from AM');
INSERT INTO public.collection VALUES (137, 'Jan/21', 'Others', 'RM-East', 'Value', '84272', '1111868', 'Client_228', 'DAYS UPTO 60', '-0.104842473', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (138, 'Jan/21', 'Others', 'RM-East', 'Value', '84272', '1111950', 'Client_242', 'DAYS  91-150', '-0.102327645', '-0.182396262', '-0.153592858', '0', '-0.153916348', 'Remarks from AM');
INSERT INTO public.collection VALUES (139, 'Jan/21', 'Others', 'RM-East', 'Value', '84308', '1112495', 'Client_7', 'WITHIN CR PD', '-0.109663341', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (140, 'Jan/21', 'Others', 'RM-East', 'Value', '84356', '1113206', 'Client_100', 'WITHIN CR PD', '0.178147548', '1.625107453', '1.382268643', '0', '1.380185349', 'Remarks from AM');
INSERT INTO public.collection VALUES (141, 'Jan/21', 'Others', 'RM-North', 'EPS', '50236', '1107705', 'Client_0', 'DAYS 61-90', '0.026595029', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1256, '1', '2', '3', '4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO public.collection VALUES (142, 'Jan/21', 'Others', 'RM-North', 'EPS', '50236', '1107705', 'Client_0', 'WITHIN CR PD', '0.026595029', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (143, 'Jan/21', 'Others', 'RM-North', 'EPS', '50250', '1110316', 'Client_255', 'DAYS UPTO 60', '-0.10858022', '-0.159074749', '-0.1878315', '0', '-0.188115759', 'Remarks from AM');
INSERT INTO public.collection VALUES (144, 'Jan/21', 'Others', 'RM-North', 'EPS', '50250', '1110316', 'Client_255', 'WITHIN CR PD', '-0.10858022', '-0.159074749', '-0.1878315', '0', '-0.188115759', 'Remarks from AM');
INSERT INTO public.collection VALUES (145, 'Jan/21', 'Others', 'RM-North', 'EPS', '50250', '1110459', 'Client_262', 'DAYS UPTO 60', '-0.073725414', '0.057811551', '0.003030852', '0', '0.002527901', 'Remarks from AM');
INSERT INTO public.collection VALUES (146, 'Jan/21', 'Others', 'RM-North', 'EPS', '50250', '1110459', 'Client_262', 'WITHIN CR PD', '-0.10858022', '-0.159074749', '-0.1878315', '0', '-0.188115759', 'Remarks from AM');
INSERT INTO public.collection VALUES (147, 'Jan/21', 'Others', 'RM-North', 'EPS', '50250', '1110460', 'Client_263', 'ADVANCE', '-0.112372246', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (148, 'Jan/21', 'Others', 'RM-North', 'EPS', '50250', '1110461', 'Client_261', 'ADVANCE', '-0.112679459', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (149, 'Jan/21', 'Others', 'RM-North', 'EPS', '50250', '1110461', 'Client_261', 'DAYS  91-150', '-0.089965782', '-0.043245196', '-0.085900207', '0', '-0.08630126', 'Remarks from AM');
INSERT INTO public.collection VALUES (150, 'Jan/21', 'Others', 'RM-North', 'EPS', '50250', '1110461', 'Client_261', 'DAYS 61-90', '-0.090090813', '-0.044023208', '-0.086584867', '0', '-0.086985135', 'Remarks from AM');
INSERT INTO public.collection VALUES (151, 'Jan/21', 'Others', 'RM-North', 'EPS', '50250', '1110461', 'Client_261', 'DAYS UPTO 60', '-0.089840751', '-0.042467183', '-0.085215548', '0', '-0.085617385', 'Remarks from AM');
INSERT INTO public.collection VALUES (152, 'Jan/21', 'Others', 'RM-North', 'EPS', '50250', '1110461', 'Client_261', 'WITHIN CR PD', '-0.104832326', '-0.135753236', '-0.167308309', '0', '-0.167616084', 'Remarks from AM');
INSERT INTO public.collection VALUES (153, 'Jan/21', 'Others', 'RM-North', 'EPS', '50250', '1110465', 'Client_258', 'DAYS  91-150', '-0.095837684', '-0.07978349', '-0.118054312', '0', '-0.118418523', 'Remarks from AM');
INSERT INTO public.collection VALUES (154, 'Jan/21', 'Others', 'RM-North', 'EPS', '50250', '1110465', 'Client_258', 'DAYS 61-90', '-0.068293519', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (155, 'Jan/21', 'Others', 'RM-North', 'EPS', '50250', '1110465', 'Client_258', 'DAYS UPTO 60', '0.017846407', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (156, 'Jan/21', 'Others', 'RM-North', 'EPS', '50250', '1110465', 'Client_258', 'WITHIN CR PD', '-0.068353635', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (157, 'Jan/21', 'Others', 'RM-North', 'EPS', '53262', '1111396', 'Client_99', 'WITHIN CR PD', '0.011439777', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (158, 'Jan/21', 'Others', 'RM-North', 'Metal', '14299', '1109812', 'Client_206', 'WITHIN CR PD', '-0.058504817', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (159, 'Jan/21', 'Others', 'RM-North', 'Metal', '14312', '1110429', 'Client_133', 'DAYS UPTO 60', '-0.095479267', '-0.077553214', '-0.116091645', '0', '-0.116458104', 'Remarks from AM');
INSERT INTO public.collection VALUES (160, 'Jan/21', 'Others', 'RM-North', 'Metal', '14312', '1111034', 'Client_132', 'DAYS UPTO 60', '-0.110558299', '-0.171383476', '-0.198663317', '0', '-0.198935165', 'Remarks from AM');
INSERT INTO public.collection VALUES (161, 'Jan/21', 'Others', 'RM-North', 'Metal', '14312', '1111034', 'Client_132', 'WITHIN CR PD', '-0.110168317', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (162, 'Jan/21', 'Others', 'RM-North', 'Metal', '14312', '1111037', 'Client_420', 'WITHIN CR PD', '-0.055717652', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (163, 'Jan/21', 'Others', 'RM-North', 'Metal', '14312', '1111038', 'Client_422', 'WITHIN CR PD', '-0.072573655', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (164, 'Jan/21', 'Others', 'RM-North', 'Metal', '14312', '1111039', 'Client_421', 'DAYS UPTO 60', '-0.061278176', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (165, 'Jan/21', 'Others', 'RM-North', 'Metal', '14312', '1112299', 'Client_47', 'WITHIN CR PD', '-0.092668539', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (166, 'Jan/21', 'Others', 'RM-North', 'Metal', '14312', '1112325', 'Client_553', 'WITHIN CR PD', '-0.100227572', '-0.107099853', '-0.142093015', '0', '-0.142429682', 'Remarks from AM');
INSERT INTO public.collection VALUES (167, 'Jan/21', 'Others', 'RM-North', 'Metal', '14312', '1112362', 'Client_223', 'WITHIN CR PD', '-0.09871313', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (168, 'Jan/21', 'Others', 'RM-North', 'Metal', '14312', '1112431', 'Client_55', 'WITHIN CR PD', '-0.106511472', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (169, 'Jan/21', 'Others', 'RM-North', 'Metal', '14312', '1112432', 'Client_223', 'WITHIN CR PD', '-0.108003366', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (170, 'Jan/21', 'Others', 'RM-North', 'Metal', '14312', '1112433', 'Client_223', 'WITHIN CR PD', '-0.029308812', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (171, 'Jan/21', 'Others', 'RM-North', 'Metal', '14312', '1112510', 'Client_216', 'DAYS UPTO 60', '-0.103816884', '-0.153983782', '-0.183351393', '0', '-0.183640785', 'Remarks from AM');
INSERT INTO public.collection VALUES (172, 'Jan/21', 'Others', 'RM-North', 'Metal', '14312', '1112545', 'Client_517', 'DAYS UPTO 60', '-0.100530529', '-0.108985025', '-0.143751987', '0', '-0.144086753', 'Remarks from AM');
INSERT INTO public.collection VALUES (173, 'Jan/21', 'Others', 'RM-North', 'Metal', '14312', '1112592', 'Client_418', 'DAYS UPTO 60', '-0.106284032', '-0.144786572', '-0.175257746', '0', '-0.175556412', 'Remarks from AM');
INSERT INTO public.collection VALUES (174, 'Jan/21', 'Others', 'RM-North', 'Metal', '14312', '1112593', 'Client_46', 'DAYS UPTO 60', '-0.105565566', '-0.140315871', '-0.171323479', '0', '-0.171626653', 'Remarks from AM');
INSERT INTO public.collection VALUES (175, 'Jan/21', 'Others', 'RM-North', 'Metal', '14312', '1112671', 'Client_134', 'DAYS 61-90', '-0.093608798', '-0.065914103', '-0.105849097', '0', '-0.106227293', 'Remarks from AM');
INSERT INTO public.collection VALUES (176, 'Jan/21', 'Others', 'RM-North', 'Metal', '14312', '1112671', 'Client_134', 'DAYS UPTO 60', '-0.090868269', '-0.048860978', '-0.090842158', '0', '-0.091237548', 'Remarks from AM');
INSERT INTO public.collection VALUES (177, 'Jan/21', 'Others', 'RM-North', 'Metal', '14312', '1112849', 'Client_427', 'WITHIN CR PD', '-0.102298015', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (178, 'Jan/21', 'Others', 'RM-North', 'Metal', '14312', '1112851', 'Client_427', 'WITHIN CR PD', '-0.103217673', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (179, 'Jan/21', 'Others', 'RM-North', 'RA/AS', '50040', '1113132', 'Client_174', 'WITHIN CR PD', '-0.107276363', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (180, 'Jan/21', 'Others', 'RM-North', 'RA/AS', '53965', '1108607', 'Client_260', 'ADVANCE', '-0.112339382', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (181, 'Jan/21', 'Others', 'RM-North', 'RA/AS', '53965', '1110316', 'Client_255', 'WITHIN CR PD', '-0.105979262', '-0.142890118', '-0.173588845', '0', '-0.173889424', 'Remarks from AM');
INSERT INTO public.collection VALUES (182, 'Jan/21', 'Others', 'RM-North', 'RA/AS', '53965', '1110464', 'Client_259', 'WITHIN CR PD', '-0.086339406', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (183, 'Jan/21', 'Others', 'RM-North', 'RA/AS', '53965', '1110465', 'Client_258', 'ADVANCE', '-0.112471023', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (184, 'Jan/21', 'Others', 'RM-North', 'RA/AS', '53965', '1110465', 'Client_258', 'DAYS UPTO 60', '-0.030887634', '0.324372422', '0.237607377', '0', '0.236835646', 'Remarks from AM');
INSERT INTO public.collection VALUES (185, 'Jan/21', 'Others', 'RM-North', 'RA/AS', '53965', '1110465', 'Client_258', 'WITHIN CR PD', '-0.074031379', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (186, 'Jan/21', 'Others', 'RM-North', 'RA/AS', '54034', '1110815', 'Client_182', 'WITHIN CR PD', '-0.099148096', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (187, 'Jan/21', 'Others', 'RM-North', 'SAS', '83158', '1112672', 'Client_475', 'DAYS  91-150', '-0.100863894', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (188, 'Jan/21', 'Others', 'RM-North', 'SAS', '83158', '1112672', 'Client_475', 'WITHIN CR PD', '-0.084314894', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (189, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61138', '1110727', 'Client_162', 'ADVANCE', '-0.475863615', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (190, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61138', '1110727', 'Client_162', 'DAYS  91-150', '0.200346521', '1.763242002', '1.503828579', '0', '1.501606001', 'Remarks from AM');
INSERT INTO public.collection VALUES (191, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61138', '1110727', 'Client_162', 'DAYS 61-90', '-0.06527818', '0.110375011', '0.04928728', '0', '0.048731328', 'Remarks from AM');
INSERT INTO public.collection VALUES (192, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61138', '1110727', 'Client_162', 'DAYS UPTO 60', '0.57998044', '4.125538776', '3.582675962', '0', '3.578071423', 'Remarks from AM');
INSERT INTO public.collection VALUES (193, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61138', '1110727', 'Client_162', 'WITHIN CR PD', '0.398261561', '-0.182396262', '2.587596763', '0', '2.584132394', 'Remarks from AM');
INSERT INTO public.collection VALUES (194, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61138', '1111422', 'Client_161', 'ADVANCE', '-3.480732127', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (195, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61138', '1111422', 'Client_161', 'WITHIN CR PD', '-0.112126356', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (196, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112236', 'Client_161', 'ADVANCE', '-0.139100894', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (197, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112236', 'Client_161', 'DAYS ABOVE 180', '-0.098431257', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (198, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112236', 'Client_161', 'DAYS UPTO 60', '-0.097910146', '-0.092679516', '-0.129402958', '0', '-0.129754166', 'Remarks from AM');
INSERT INTO public.collection VALUES (199, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112236', 'Client_161', 'WITHIN CR PD', '0.068726535', '-0.182396262', '0.463810847', '0', '0.462779931', 'Remarks from AM');
INSERT INTO public.collection VALUES (200, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112237', 'Client_161', 'DAYS ABOVE 180', '-0.111191723', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (201, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112237', 'Client_161', 'DAYS UPTO 60', '-0.111949926', '-0.180042964', '-0.206283762', '0', '-0.206546879', 'Remarks from AM');
INSERT INTO public.collection VALUES (202, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112237', 'Client_161', 'WITHIN CR PD', '-0.110748782', '-0.182396262', '-0.202491538', '0', '-0.202759', 'Remarks from AM');
INSERT INTO public.collection VALUES (203, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112238', 'Client_161', 'ADVANCE', '-0.143233911', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (204, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112238', 'Client_161', 'DAYS ABOVE 180', '-0.111437743', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (205, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112238', 'Client_161', 'DAYS UPTO 60', '-0.105020879', '-0.136926515', '-0.168340808', '0', '-0.1686474', 'Remarks from AM');
INSERT INTO public.collection VALUES (206, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112238', 'Client_161', 'WITHIN CR PD', '-0.045566714', '-0.182396262', '0.03949537', '0', '0.038950638', 'Remarks from AM');
INSERT INTO public.collection VALUES (207, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112239', 'Client_161', 'ADVANCE', '-0.147875956', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (208, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112239', 'Client_161', 'DAYS ABOVE 180', '-0.100759885', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (209, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112239', 'Client_161', 'DAYS UPTO 60', '-0.075081105', '0.049375677', '-0.004392811', '0', '-0.004887256', 'Remarks from AM');
INSERT INTO public.collection VALUES (210, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112239', 'Client_161', 'WITHIN CR PD', '-0.014016236', '-0.182396262', '0.156625965', '0', '0.155947024', 'Remarks from AM');
INSERT INTO public.collection VALUES (211, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112240', 'Client_161', 'DAYS ABOVE 180', '-0.089055852', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (212, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112240', 'Client_161', 'DAYS UPTO 60', '-0.107462135', '-0.152117391', '-0.205869122', '0', '-0.206132713', 'Remarks from AM');
INSERT INTO public.collection VALUES (213, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112240', 'Client_161', 'WITHIN CR PD', '-0.082963563', '-0.182396262', '-0.099340142', '0', '-0.099725796', 'Remarks from AM');
INSERT INTO public.collection VALUES (214, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112244', 'Client_161', 'DAYS UPTO 60', '-0.112098608', '-0.180968148', '-0.207097934', '0', '-0.207360118', 'Remarks from AM');
INSERT INTO public.collection VALUES (215, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112244', 'Client_161', 'WITHIN CR PD', '-0.112088862', '-0.182396262', '-0.207466192', '0', '-0.207727954', 'Remarks from AM');
INSERT INTO public.collection VALUES (216, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112245', 'Client_161', 'ADVANCE', '-0.112455478', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (217, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112245', 'Client_161', 'DAYS UPTO 60', '-0.112251117', '-0.181917147', '-0.207933064', '0', '-0.208194291', 'Remarks from AM');
INSERT INTO public.collection VALUES (218, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112245', 'Client_161', 'WITHIN CR PD', '-0.112045192', '-0.182396262', '-0.207304434', '0', '-0.207566381', 'Remarks from AM');
INSERT INTO public.collection VALUES (219, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112246', 'Client_161', 'DAYS UPTO 60', '-0.112281034', '-0.182103305', '-0.208096885', '0', '-0.208357924', 'Remarks from AM');
INSERT INTO public.collection VALUES (220, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112247', 'Client_161', 'ADVANCE', '-0.142122098', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (221, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112247', 'Client_161', 'DAYS ABOVE 180', '-0.097006295', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (222, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112247', 'Client_161', 'DAYS UPTO 60', '-0.017312816', '0.408842612', '-0.195161507', '0', '-0.195437368', 'Remarks from AM');
INSERT INTO public.collection VALUES (223, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112247', 'Client_161', 'WITHIN CR PD', '0.131611977', '-0.182396262', '0.697270279', '0', '0.695971863', 'Remarks from AM');
INSERT INTO public.collection VALUES (224, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112248', 'Client_161', 'ADVANCE', '-0.112582842', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (225, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112248', 'Client_161', 'DAYS ABOVE 180', '-0.111023503', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (226, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112248', 'Client_161', 'DAYS UPTO 60', '-0.101780718', '-0.116764404', '-0.205774188', '0', '-0.206037889', 'Remarks from AM');
INSERT INTO public.collection VALUES (227, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112248', 'Client_161', 'WITHIN CR PD', '-0.092883485', '-0.182396262', '-0.136167116', '0', '-0.136510573', 'Remarks from AM');
INSERT INTO public.collection VALUES (228, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112249', 'Client_161', 'DAYS ABOVE 180', '-0.111848703', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (229, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112249', 'Client_161', 'DAYS UPTO 60', '-0.111943648', '-0.180003897', '-0.206249383', '0', '-0.206512539', 'Remarks from AM');
INSERT INTO public.collection VALUES (230, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112249', 'Client_161', 'WITHIN CR PD', '-0.109937456', '-0.182396262', '-0.199479082', '0', '-0.199749996', 'Remarks from AM');
INSERT INTO public.collection VALUES (231, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112250', 'Client_161', 'DAYS ABOVE 180', '-0.103657841', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (232, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112250', 'Client_161', 'DAYS UPTO 60', '-0.106488551', '-0.146059204', '-0.207513875', '0', '-0.207775582', 'Remarks from AM');
INSERT INTO public.collection VALUES (233, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112250', 'Client_161', 'WITHIN CR PD', '-0.088577944', '-0.182396262', '-0.120182348', '0', '-0.12054412', 'Remarks from AM');
INSERT INTO public.collection VALUES (234, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112251', 'Client_161', 'DAYS ABOVE 180', '-0.093476894', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1257, '2', '3', '4', '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO public.collection VALUES (235, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112251', 'Client_161', 'DAYS UPTO 60', '-0.044945389', '0.236897128', '-0.200987068', '0', '-0.201256254', 'Remarks from AM');
INSERT INTO public.collection VALUES (236, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112251', 'Client_161', 'WITHIN CR PD', '0.046569219', '-0.182396262', '0.381550888', '0', '0.380614226', 'Remarks from AM');
INSERT INTO public.collection VALUES (237, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112252', 'Client_161', 'ADVANCE', '-0.117558816', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (238, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112252', 'Client_161', 'DAYS ABOVE 180', '-0.101985613', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (239, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112252', 'Client_161', 'DAYS UPTO 60', '-0.093527656', '-0.065409187', '-0.195847609', '0', '-0.196122683', 'Remarks from AM');
INSERT INTO public.collection VALUES (240, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112252', 'Client_161', 'WITHIN CR PD', '-0.040075185', '-0.182396262', '0.059885122', '0', '0.059317026', 'Remarks from AM');
INSERT INTO public.collection VALUES (241, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112253', 'Client_161', 'DAYS ABOVE 180', '-0.106670414', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (242, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112253', 'Client_161', 'DAYS UPTO 60', '-0.104284492', '-0.1323443', '-0.207513875', '0', '-0.207775582', 'Remarks from AM');
INSERT INTO public.collection VALUES (243, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112253', 'Client_161', 'WITHIN CR PD', '-0.074154468', '-0.182396262', '-0.066634488', '0', '-0.067057616', 'Remarks from AM');
INSERT INTO public.collection VALUES (244, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112254', 'Client_161', 'ADVANCE', '-0.113596189', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (245, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112254', 'Client_161', 'DAYS ABOVE 180', '-0.091925247', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (246, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112254', 'Client_161', 'DAYS UPTO 60', '-0.077583564', '0.033803959', '-0.194807456', '0', '-0.195083722', 'Remarks from AM');
INSERT INTO public.collection VALUES (247, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112254', 'Client_161', 'WITHIN CR PD', '-0.019680846', '-0.182396262', '0.135598558', '0', '0.134943709', 'Remarks from AM');
INSERT INTO public.collection VALUES (248, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112255', 'Client_161', 'DAYS ABOVE 180', '-0.091662688', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (249, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112255', 'Client_161', 'DAYS UPTO 60', '-0.017438534', '0.408060324', '-0.20105598', '0', '-0.201325086', 'Remarks from AM');
INSERT INTO public.collection VALUES (250, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112255', 'Client_161', 'WITHIN CR PD', '0.099429046', '-0.182396262', '0.577790672', '0', '0.576629156', 'Remarks from AM');
INSERT INTO public.collection VALUES (251, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112256', 'Client_161', 'DAYS ABOVE 180', '-0.108753242', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (252, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112256', 'Client_161', 'DAYS UPTO 60', '-0.094838112', '-0.073563586', '-0.203519231', '0', '-0.203785515', 'Remarks from AM');
INSERT INTO public.collection VALUES (253, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112256', 'Client_161', 'WITHIN CR PD', '-0.067493848', '-0.182396262', '-0.041908911', '0', '-0.04236037', 'Remarks from AM');
INSERT INTO public.collection VALUES (254, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112257', 'Client_161', 'DAYS 61-90', '-0.11194329', '-0.180001673', '-0.206247425', '0', '-0.206510583', 'Remarks from AM');
INSERT INTO public.collection VALUES (255, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112257', 'Client_161', 'DAYS ABOVE 180', '-0.099177823', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (256, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112257', 'Client_161', 'DAYS UPTO 60', '-0.103502795', '-0.127480143', '-0.205504357', '0', '-0.205768366', 'Remarks from AM');
INSERT INTO public.collection VALUES (257, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112257', 'Client_161', 'WITHIN CR PD', '-0.015247609', '-0.182396262', '0.152056879', '0', '0.151383173', 'Remarks from AM');
INSERT INTO public.collection VALUES (258, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112258', 'Client_161', 'DAYS ABOVE 180', '-0.089273251', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (259, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112258', 'Client_161', 'DAYS UPTO 60', '-0.094396891', '-0.070818059', '-0.201360226', '0', '-0.201628984', 'Remarks from AM');
INSERT INTO public.collection VALUES (260, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61174', '1112258', 'Client_161', 'WITHIN CR PD', '-0.040322018', '-0.182396262', '0.058966147', '0', '0.058399105', 'Remarks from AM');
INSERT INTO public.collection VALUES (261, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61186', '1113102', 'Client_27', 'WITHIN CR PD', '-0.09385996', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (262, 'Jan/21', 'Others', 'RM-North', 'StraightLine', '61186', '1113103', 'Client_24', 'WITHIN CR PD', '-0.109826489', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (263, 'Jan/21', 'Others', 'RM-North', 'Value', '83014', '1112638', 'Client_153', 'DAYS 61-90', '-0.074900387', '0.050500205', '-0.003403214', '0', '-0.003898793', 'Remarks from AM');
INSERT INTO public.collection VALUES (264, 'Jan/21', 'Others', 'RM-North', 'Value', '83014', '1112638', 'Client_153', 'DAYS UPTO 60', '-0.076691275', '0.039356286', '-0.013209987', '0', '-0.013694329', 'Remarks from AM');
INSERT INTO public.collection VALUES (265, 'Jan/21', 'Others', 'RM-North', 'Value', '83014', '1112644', 'Client_145', 'DAYS 61-90', '-0.062990225', '0.12461196', '0.061815953', '0', '0.061245646', 'Remarks from AM');
INSERT INTO public.collection VALUES (266, 'Jan/21', 'Others', 'RM-North', 'Value', '83014', '1112645', 'Client_144', 'DAYS 61-90', '-0.106007723', '-0.143067219', '-0.173744696', '0', '-0.174045096', 'Remarks from AM');
INSERT INTO public.collection VALUES (267, 'Jan/21', 'Others', 'RM-North', 'Value', '83014', '1112645', 'Client_144', 'DAYS UPTO 60', '-0.096193604', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (268, 'Jan/21', 'Others', 'RM-North', 'Value', '84157', '1112161', 'Client_140', 'DAYS UPTO 60', '-0.066348381', '0.103715619', '0.043426941', '0', '0.042877704', 'Remarks from AM');
INSERT INTO public.collection VALUES (269, 'Jan/21', 'Others', 'RM-North', 'Value', '84157', '1112161', 'Client_140', 'WITHIN CR PD', '-0.053119289', '0.186034506', '0.115868475', '0', '0.115236234', 'Remarks from AM');
INSERT INTO public.collection VALUES (270, 'Jan/21', 'Others', 'RM-North', 'Value', '84175', '1109812', 'Client_206', 'WITHIN CR PD', '-0.111358387', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (271, 'Jan/21', 'Others', 'RM-North', 'Value', '84229', '1110901', 'Client_111', 'DAYS  91-150', '-0.112327103', '-0.182389975', '-0.208349158', '0', '-0.208609908', 'Remarks from AM');
INSERT INTO public.collection VALUES (272, 'Jan/21', 'Others', 'RM-North', 'Value', '84229', '1110901', 'Client_111', 'DAYS 61-90', '-0.110464018', '-0.170796803', '-0.198147038', '0', '-0.198419478', 'Remarks from AM');
INSERT INTO public.collection VALUES (273, 'Jan/21', 'Others', 'RM-North', 'Value', '84229', '1110901', 'Client_111', 'DAYS UPTO 60', '-0.109455688', '-0.182361684', '-0.208324261', '0', '-0.20858504', 'Remarks from AM');
INSERT INTO public.collection VALUES (274, 'Jan/21', 'Others', 'RM-North', 'Value', '84229', '1110901', 'Client_111', 'WITHIN CR PD', '-0.107964412', '-0.181666974', '-0.207712908', '0', '-0.207974387', 'Remarks from AM');
INSERT INTO public.collection VALUES (275, 'Jan/21', 'Others', 'RM-North', 'Value', '84229', '1110902', 'Client_111', 'DAYS 151-180', '-0.112322557', '-0.182361684', '-0.208324261', '0', '-0.20858504', 'Remarks from AM');
INSERT INTO public.collection VALUES (276, 'Jan/21', 'Others', 'RM-North', 'Value', '84229', '1110902', 'Client_111', 'DAYS 61-90', '-0.112210913', '-0.181666974', '-0.207712908', '0', '-0.207974387', 'Remarks from AM');
INSERT INTO public.collection VALUES (277, 'Jan/21', 'Others', 'RM-North', 'Value', '84229', '1110902', 'Client_111', 'DAYS ABOVE 180', '-0.062357712', '0.128547816', '0.06527955', '0', '0.064705274', 'Remarks from AM');
INSERT INTO public.collection VALUES (278, 'Jan/21', 'Others', 'RM-North', 'Value', '84229', '1110902', 'Client_111', 'DAYS UPTO 60', '-0.112138168', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (279, 'Jan/21', 'Others', 'RM-North', 'Value', '84229', '1110903', 'Client_111', 'DAYS ABOVE 180', '-0.11231801', '-0.182333392', '-0.208299364', '0', '-0.208560171', 'Remarks from AM');
INSERT INTO public.collection VALUES (280, 'Jan/21', 'Others', 'RM-North', 'Value', '84229', '1110904', 'Client_111', 'DAYS 151-180', '-0.11231801', '-0.182333392', '-0.208299364', '0', '-0.208560171', 'Remarks from AM');
INSERT INTO public.collection VALUES (281, 'Jan/21', 'Others', 'RM-North', 'Value', '84229', '1110908', 'Client_111', 'DAYS 151-180', '-0.112325588', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (282, 'Jan/21', 'Others', 'RM-North', 'Value', '84229', '1110909', 'Client_111', 'DAYS UPTO 60', '-0.09985029', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (283, 'Jan/21', 'Others', 'RM-North', 'Value', '84229', '1110909', 'Client_111', 'WITHIN CR PD', '-0.108034126', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (284, 'Jan/21', 'Others', 'RM-North', 'Value', '84229', '1110912', 'Client_111', 'DAYS  91-150', '-0.112326598', '-0.182386832', '-0.208346391', '0', '-0.208607145', 'Remarks from AM');
INSERT INTO public.collection VALUES (285, 'Jan/21', 'Others', 'RM-North', 'Value', '84229', '1110912', 'Client_111', 'DAYS 151-180', '-0.112326093', '-0.182383688', '-0.208343625', '0', '-0.208604382', 'Remarks from AM');
INSERT INTO public.collection VALUES (286, 'Jan/21', 'Others', 'RM-North', 'Value', '84229', '1110912', 'Client_111', 'DAYS UPTO 60', '-0.112318515', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (287, 'Jan/21', 'Others', 'RM-North', 'Value', '84229', '1110914', 'Client_111', 'DAYS 61-90', '-0.112327103', '-0.182389975', '-0.208349158', '0', '-0.208609908', 'Remarks from AM');
INSERT INTO public.collection VALUES (288, 'Jan/21', 'Others', 'RM-North', 'Value', '84229', '1110916', 'Client_111', 'DAYS UPTO 60', '-0.10571032', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (289, 'Jan/21', 'Others', 'RM-North', 'Value', '84229', '1110917', 'Client_111', 'DAYS 61-90', '-0.110943934', '-0.173783114', '-0.200775024', '0', '-0.201044453', 'Remarks from AM');
INSERT INTO public.collection VALUES (290, 'Jan/21', 'Others', 'RM-North', 'Value', '84229', '1110917', 'Client_111', 'DAYS UPTO 60', '-0.10921371', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (291, 'Jan/21', 'Others', 'RM-North', 'Value', '84229', '1110917', 'Client_111', 'WITHIN CR PD', '-0.110734286', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (292, 'Jan/21', 'Others', 'RM-North', 'Value', '84229', '1110919', 'Client_111', 'DAYS  91-150', '-0.112321547', '-0.182355397', '-0.208318728', '0', '-0.208579513', 'Remarks from AM');
INSERT INTO public.collection VALUES (293, 'Jan/21', 'Others', 'RM-North', 'Value', '84229', '1110920', 'Client_111', 'DAYS  91-150', '-0.112327103', '-0.182389975', '-0.208349158', '0', '-0.208609908', 'Remarks from AM');
INSERT INTO public.collection VALUES (294, 'Jan/21', 'Others', 'RM-North', 'Value', '84229', '1110920', 'Client_111', 'DAYS 151-180', '-0.112216975', '-0.181704695', '-0.207746104', '0', '-0.208007545', 'Remarks from AM');
INSERT INTO public.collection VALUES (295, 'Jan/21', 'Others', 'RM-North', 'Value', '84229', '1110920', 'Client_111', 'DAYS ABOVE 180', '-0.111508215', '-0.177294386', '-0.203864983', '0', '-0.204130871', 'Remarks from AM');
INSERT INTO public.collection VALUES (296, 'Jan/21', 'Others', 'RM-North', 'Value', '84245', '1112956', 'Client_182', 'WITHIN CR PD', '-0.098870295', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (297, 'Jan/21', 'Others', 'RM-North', 'Value', '84252', '1111551', 'Client_155', 'DAYS ABOVE 180', '-0.004978413', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (298, 'Jan/21', 'Others', 'RM-North', 'Value', '84254', '1111599', 'Client_169', 'WITHIN CR PD', '-0.085386815', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (299, 'Jan/21', 'Others', 'RM-North', 'Value', '84264', '1111775', 'Client_36', 'WITHIN CR PD', '-0.062148375', '0.129850431', '0.066425866', '0', '0.065850276', 'Remarks from AM');
INSERT INTO public.collection VALUES (300, 'Jan/21', 'Others', 'RM-North', 'Value', '84270', '1111924', 'Client_231', 'DAYS UPTO 60', '-0.088581298', '-0.034630156', '-0.078318877', '0', '-0.078728617', 'Remarks from AM');
INSERT INTO public.collection VALUES (301, 'Jan/21', 'Others', 'RM-North', 'Value', '84270', '1112638', 'Client_153', 'DAYS UPTO 60', '-0.092565015', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (302, 'Jan/21', 'Others', 'RM-North', 'Value', '84270', '1112638', 'Client_153', 'WITHIN CR PD', '-0.080586492', '0.015118047', '-0.034539906', '0', '-0.034999808', 'Remarks from AM');
INSERT INTO public.collection VALUES (303, 'Jan/21', 'Others', 'RM-North', 'Value', '84270', '1112640', 'Client_32', 'DAYS UPTO 60', '-0.091992315', '-0.055855431', '-0.096997354', '0', '-0.097385692', 'Remarks from AM');
INSERT INTO public.collection VALUES (304, 'Jan/21', 'Others', 'RM-North', 'Value', '84270', '1112640', 'Client_32', 'WITHIN CR PD', '-0.09907948', '-0.099955778', '-0.135806149', '0', '-0.13615002', 'Remarks from AM');
INSERT INTO public.collection VALUES (305, 'Jan/21', 'Others', 'RM-North', 'Value', '84270', '1112644', 'Client_145', 'DAYS UPTO 60', '-0.106543483', '-0.146401018', '-0.176678476', '0', '-0.176975514', 'Remarks from AM');
INSERT INTO public.collection VALUES (306, 'Jan/21', 'Others', 'RM-North', 'Value', '84270', '1112644', 'Client_145', 'WITHIN CR PD', '-0.09636145', '-0.083042658', '-0.120922416', '0', '-0.12128334', 'Remarks from AM');
INSERT INTO public.collection VALUES (307, 'Jan/21', 'Others', 'RM-North', 'Value', '84270', '1112645', 'Client_144', 'DAYS UPTO 60', '-0.103889768', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (308, 'Jan/21', 'Others', 'RM-North', 'Value', '84270', '1112646', 'Client_146', 'DAYS UPTO 60', '-0.101912138', '-0.117582176', '-0.151317575', '0', '-0.151643672', 'Remarks from AM');
INSERT INTO public.collection VALUES (309, 'Jan/21', 'Others', 'RM-North', 'Value', '84270', '1112647', 'Client_147', 'DAYS UPTO 60', '-0.11040557', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (310, 'Jan/21', 'Others', 'RM-North', 'Value', '84270', '1112647', 'Client_147', 'WITHIN CR PD', '-0.107753942', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (311, 'Jan/21', 'Others', 'RM-North', 'Value', '84270', '1113071', 'Client_217', 'DAYS UPTO 60', '-0.10321351', '-0.125680045', '-0.15844379', '0', '-0.158761722', 'Remarks from AM');
INSERT INTO public.collection VALUES (312, 'Jan/21', 'Others', 'RM-North', 'Value', '84270', '1113071', 'Client_217', 'WITHIN CR PD', '-0.031355063', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (313, 'Jan/21', 'Others', 'RM-North', 'Value', '84272', '1112619', 'Client_235', 'WITHIN CR PD', '-0.109384206', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (314, 'Jan/21', 'Others', 'RM-North', 'Value', '84289', '1009554', 'Client_158', 'WITHIN CR PD', '0.010808308', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (315, 'Jan/21', 'Others', 'RM-North', 'Value', '84306', '1112583', 'Client_449', 'DAYS UPTO 60', '-0.081268594', '0.010873623', '-0.038275046', '0', '-0.038730668', 'Remarks from AM');
INSERT INTO public.collection VALUES (316, 'Jan/21', 'Others', 'RM-North', 'Value', '84306', '1112583', 'Client_449', 'WITHIN CR PD', '-0.101952734', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (317, 'Jan/21', 'Others', 'RM-North', 'Value', '84306', '1112733', 'Client_449', 'DAYS UPTO 60', '-0.071278812', '0.073035688', '0.016428261', '0', '0.015909959', 'Remarks from AM');
INSERT INTO public.collection VALUES (318, 'Jan/21', 'Others', 'RM-North', 'Value', '84306', '1112733', 'Client_449', 'WITHIN CR PD', '-0.082059302', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (319, 'Jan/21', 'Others', 'RM-North', 'Value', '84312', '1112760', 'Client_66', 'WITHIN CR PD', '-0.108593119', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (320, 'Jan/21', 'Others', 'RM-North', 'Value', '84319', '1112653', 'Client_284', 'DAYS UPTO 60', '-0.095436323', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (321, 'Jan/21', 'Others', 'RM-North', 'Value', '84320', '1112606', 'Client_412', 'DAYS UPTO 60', '-0.103392072', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (322, 'Jan/21', 'Others', 'RM-North', 'Value', '84331', '1112814', 'Client_67', 'DAYS 151-180', '-0.095930131', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (323, 'Jan/21', 'Others', 'RM-North', 'Value', '84331', '1112814', 'Client_67', 'DAYS ABOVE 180', '-0.009580643', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (324, 'Jan/21', 'Others', 'RM-North', 'Value', '84333', '1112829', 'Client_529', 'DAYS  91-150', '0.030124833', '0.70402647', '0.571707153', '0', '0.570552608', 'Remarks from AM');
INSERT INTO public.collection VALUES (325, 'Jan/21', 'Others', 'RM-North', 'Value', '84333', '1112829', 'Client_529', 'DAYS 61-90', '0.003603142', '0.538993522', '0.426476327', '0', '0.425488189', 'Remarks from AM');
INSERT INTO public.collection VALUES (326, 'Jan/21', 'Others', 'RM-North', 'Value', '84333', '1112829', 'Client_529', 'DAYS UPTO 60', '0.090745841', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (327, 'Jan/21', 'Others', 'RM-North', 'Value', '84333', '1112829', 'Client_529', 'WITHIN CR PD', '-0.08201761', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1258, '1', '2', '3', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO public.collection VALUES (328, 'Jan/21', 'Others', 'RM-North', 'Value', '84340', '1112879', 'Client_546', 'DAYS ABOVE 180', '-0.078078957', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (329, 'Jan/21', 'Others', 'RM-South', 'Coal', '20927', '1112436', 'Client_226', 'WITHIN CR PD', '0.422806281', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (330, 'Jan/21', 'Others', 'RM-South', 'EPS', '53255', '1110560', 'Client_275', 'DAYS UPTO 60', '-0.102583792', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (331, 'Jan/21', 'Others', 'RM-South', 'EPS', '53255', '1110560', 'Client_275', 'WITHIN CR PD', '-0.097086982', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (332, 'Jan/21', 'Others', 'RM-South', 'EPS', '53257', '1110621', 'Client_477', 'DAYS UPTO 60', '-0.034025979', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (333, 'Jan/21', 'Others', 'RM-South', 'EPS', '53257', '1110621', 'Client_477', 'WITHIN CR PD', '-0.034025979', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (334, 'Jan/21', 'Others', 'RM-South', 'Metal', '14308', '1110280', 'Client_287', 'ADVANCE', '-0.495107367', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (335, 'Jan/21', 'Others', 'RM-South', 'Metal', '14308', '1110280', 'Client_287', 'DAYS 151-180', '0.029266754', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (336, 'Jan/21', 'Others', 'RM-South', 'Metal', '14308', '1110280', 'Client_287', 'DAYS ABOVE 180', '1.075888845', '3.680360388', '3.190914039', '0', '3.186758384', 'Remarks from AM');
INSERT INTO public.collection VALUES (337, 'Jan/21', 'Others', 'RM-South', 'Metal', '14322', '1111009', 'Client_191', 'DAYS UPTO 60', '-0.068959843', '-0.182396262', '0.029126768', '0', '0.028593916', 'Remarks from AM');
INSERT INTO public.collection VALUES (338, 'Jan/21', 'Others', 'RM-South', 'MSS/CMS', '50008', '1110369', 'Client_286', 'ADVANCE', '-0.125967841', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (339, 'Jan/21', 'Others', 'RM-South', 'MSS/CMS', '50008', '1110369', 'Client_286', 'DAYS 61-90', '-0.090237337', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (340, 'Jan/21', 'Others', 'RM-South', 'MSS/CMS', '50008', '1110369', 'Client_286', 'DAYS ABOVE 180', '0.226819882', '0.550195516', '0.436334207', '0', '0.435334773', 'Remarks from AM');
INSERT INTO public.collection VALUES (341, 'Jan/21', 'Others', 'RM-South', 'MSS/CMS', '53108', '1112674', 'Client_208', 'DAYS UPTO 60', '0.190776925', '1.703694571', '1.451426179', '0', '1.449263644', 'Remarks from AM');
INSERT INTO public.collection VALUES (342, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_54', 'DAYS ABOVE 180', '-0.11192894', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (343, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_68', 'DAYS  91-150', '-0.112328099', '-0.182396262', '-0.20835469', '0', '', 'Remarks from AM');
INSERT INTO public.collection VALUES (344, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_68', 'DAYS ABOVE 180', '-0.102706522', '-0.122536854', '-0.155677747', '0', '-0.155998848', 'Remarks from AM');
INSERT INTO public.collection VALUES (345, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_69', 'DAYS  91-150', '-0.10621423', '-0.144352238', '-0.174875527', '0', '-0.175174631', 'Remarks from AM');
INSERT INTO public.collection VALUES (346, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_69', 'DAYS ABOVE 180', '-0.059438564', '0.103020163', '0.042814932', '0', '0.042266396', 'Remarks from AM');
INSERT INTO public.collection VALUES (347, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_69', 'DAYS UPTO 60', '0.011449532', '0.246444317', '0.16902978', '0', '0.168336626', 'Remarks from AM');
INSERT INTO public.collection VALUES (348, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_71', 'DAYS  91-150', '-0.111807781', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (349, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_71', 'DAYS 61-90', '-0.105835687', '-0.141997155', '-0.172803028', '0', '-0.173104507', 'Remarks from AM');
INSERT INTO public.collection VALUES (350, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_71', 'DAYS ABOVE 180', '-0.10608415', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (351, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_71', 'DAYS UPTO 60', '-0.097048214', '-0.096742963', '-0.132978837', '0', '-0.133325947', 'Remarks from AM');
INSERT INTO public.collection VALUES (352, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_71', 'WITHIN CR PD', '0.334903378', '0.749993274', '0.612158451', '0', '0.610957556', 'Remarks from AM');
INSERT INTO public.collection VALUES (353, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_70', 'DAYS 151-180', '-0.109206132', '-0.163748471', '-0.191944428', '0', '-0.192223974', 'Remarks from AM');
INSERT INTO public.collection VALUES (354, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_70', 'DAYS UPTO 60', '-0.108269537', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (355, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_70', 'WITHIN CR PD', '-0.104822349', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (356, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_72', 'DAYS ABOVE 180', '-0.099672278', '-0.129383257', '-0.161702657', '0', '-0.162016855', 'Remarks from AM');
INSERT INTO public.collection VALUES (357, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_72', 'DAYS UPTO 60', '-0.106898978', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (358, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_72', 'WITHIN CR PD', '-0.045292654', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (359, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_73', 'ADVANCE', '-0.129548393', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (360, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_73', 'DAYS  91-150', '-0.025025675', '-0.021092872', '-0.066405917', '0', '-0.066829307', 'Remarks from AM');
INSERT INTO public.collection VALUES (361, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_73', 'DAYS 151-180', '0.02169521', '-0.182396262', '-0.20835469', '0', '', 'Remarks from AM');
INSERT INTO public.collection VALUES (362, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_73', 'DAYS 61-90', '0.19667198', '-0.162416486', '-0.190772266', '0', '-0.191053156', 'Remarks from AM');
INSERT INTO public.collection VALUES (363, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_73', 'DAYS ABOVE 180', '0.229365294', '0.109308464', '0.048348707', '0', '0.04779383', 'Remarks from AM');
INSERT INTO public.collection VALUES (364, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_73', 'DAYS UPTO 60', '0.957112639', '1.683714795', '1.433843754', '0', '1.431701366', 'Remarks from AM');
INSERT INTO public.collection VALUES (365, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_73', 'WITHIN CR PD', '4.535199454', '7.997323941', '6.989889884', '0', '6.98138133', 'Remarks from AM');
INSERT INTO public.collection VALUES (366, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_74', 'DAYS ABOVE 180', '-0.10539385', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (367, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_75', 'DAYS UPTO 60', '-0.109466297', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (368, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_75', 'WITHIN CR PD', '-0.067661725', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (369, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_76', 'ADVANCE', '-0.114709286', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (370, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_76', 'DAYS  91-150', '-0.112328045', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (371, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_76', 'DAYS 151-180', '-0.105954067', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (372, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_76', 'DAYS 61-90', '-0.111079321', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (373, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_76', 'DAYS ABOVE 180', '-0.099243966', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (374, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_76', 'DAYS UPTO 60', '-0.024119459', '0.350397759', '0.260509962', '0', '0.259711989', 'Remarks from AM');
INSERT INTO public.collection VALUES (1259, '12e3ds', 'asc', 'aswc', 'sdc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO public.collection VALUES (375, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_76', 'WITHIN CR PD', '1.025386257', '2.835881865', '2.447763565', '0', '2.444459418', 'Remarks from AM');
INSERT INTO public.collection VALUES (376, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_77', 'DAYS 61-90', '-0.108425636', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (377, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_77', 'DAYS ABOVE 180', '-0.110676482', '-0.172119997', '-0.199311463', '0', '-0.199582569', 'Remarks from AM');
INSERT INTO public.collection VALUES (378, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_77', 'DAYS UPTO 60', '-0.080900163', '-0.043495529', '-0.086120503', '0', '-0.086521304', 'Remarks from AM');
INSERT INTO public.collection VALUES (379, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_77', 'WITHIN CR PD', '0.054930127', '0.355696395', '0.265172821', '0', '0.264369505', 'Remarks from AM');
INSERT INTO public.collection VALUES (380, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_282', 'DAYS UPTO 60', '-0.046821367', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (381, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_282', 'WITHIN CR PD', '-0.005914127', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (382, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_290', 'DAYS ABOVE 180', '-0.074384969', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (383, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_291', 'WITHIN CR PD', '-0.094087933', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (384, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_292', 'WITHIN CR PD', '-0.036826624', '0.127945599', '0.064749592', '0', '0.064175923', 'Remarks from AM');
INSERT INTO public.collection VALUES (385, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_293', 'ADVANCE', '-0.241688881', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (386, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_293', 'DAYS  91-150', '0.06545326', '0.923151331', '0.764539463', '0', '0.763163969', 'Remarks from AM');
INSERT INTO public.collection VALUES (387, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_293', 'DAYS 151-180', '-0.024351129', '0.363717609', '0.272231578', '0', '0.271420175', 'Remarks from AM');
INSERT INTO public.collection VALUES (388, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_293', 'DAYS 61-90', '0.27045353', '1.804925435', '1.540510463', '0', '1.538245854', 'Remarks from AM');
INSERT INTO public.collection VALUES (389, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_293', 'DAYS ABOVE 180', '0.089177873', '0.744665334', '0.607469805', '0', '0.606274282', 'Remarks from AM');
INSERT INTO public.collection VALUES (390, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_293', 'DAYS UPTO 60', '0.267629505', '1.597135767', '1.357653248', '0', '1.355598159', 'Remarks from AM');
INSERT INTO public.collection VALUES (391, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_293', 'WITHIN CR PD', '3.119373986', '4.095939724', '3.556628468', '0', '3.552053774', 'Remarks from AM');
INSERT INTO public.collection VALUES (392, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_294', 'DAYS  91-150', '-0.108165471', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (393, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_294', 'DAYS 61-90', '-0.103362778', '-0.126612728', '-0.159264561', '0', '-0.159581553', 'Remarks from AM');
INSERT INTO public.collection VALUES (394, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_294', 'DAYS ABOVE 180', '-0.090411055', '-0.148031048', '-0.17811292', '0', '-0.178408315', 'Remarks from AM');
INSERT INTO public.collection VALUES (395, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_294', 'DAYS UPTO 60', '-0.10713826', '-0.166678838', '-0.194523183', '0', '-0.194799775', 'Remarks from AM');
INSERT INTO public.collection VALUES (396, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_294', 'WITHIN CR PD', '0.439063842', '-0.00257828', '-0.05011287', '0', '-0.050554929', 'Remarks from AM');
INSERT INTO public.collection VALUES (397, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_295', 'WITHIN CR PD', '0.015509288', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (398, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_296', 'DAYS 61-90', '-0.034037553', '0.303778282', '0.219484305', '0', '0.21873334', 'Remarks from AM');
INSERT INTO public.collection VALUES (399, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_296', 'DAYS UPTO 60', '-0.036491644', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (400, 'Jan/21', 'Others', 'RM-South', 'PSP-BOSCH', '53304', '53304', 'Client_296', 'WITHIN CR PD', '0.000113168', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (401, 'Jan/21', 'Others', 'RM-South', 'Value', '84203', '1110329', 'Client_207', 'DAYS UPTO 60', '-0.106393906', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (402, 'Jan/21', 'Others', 'RM-South', 'Value', '84236', '1111084', 'Client_113', 'DAYS 61-90', '-0.107624454', '-0.153127436', '-0.182597798', '0', '-0.182888054', 'Remarks from AM');
INSERT INTO public.collection VALUES (403, 'Jan/21', 'Others', 'RM-South', 'Value', '84236', '1111084', 'Client_113', 'DAYS UPTO 60', '-0.105272625', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (404, 'Jan/21', 'Others', 'RM-South', 'Value', '84236', '1111084', 'Client_113', 'WITHIN CR PD', '-0.107624454', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (405, 'Jan/21', 'Others', 'RM-South', 'Value', '84246', '1111305', 'Client_128', 'DAYS UPTO 60', '-0.039754264', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (406, 'Jan/21', 'Others', 'RM-South', 'Value', '84270', '1111994', 'Client_439', 'WITHIN CR PD', '-0.100692395', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (407, 'Jan/21', 'Others', 'RM-South', 'Value', '84270', '1112367', 'Client_232', 'WITHIN CR PD', '-0.06813026', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (408, 'Jan/21', 'Others', 'RM-South', 'Value', '84270', '1112869', 'Client_230', 'WITHIN CR PD', '-0.108090297', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (409, 'Jan/21', 'Others', 'RM-South', 'Value', '84335', '1112832', 'Client_473', 'DAYS ABOVE 180', '0.405981503', '3.042819063', '2.629870596', '0', '2.626357789', 'Remarks from AM');
INSERT INTO public.collection VALUES (410, 'Jan/21', 'Others', 'RM-West', 'Metal', '11909', '1113069', 'Client_224', 'WITHIN CR PD', '0.007320595', '0.562125614', '0.446832825', '0', '0.445821361', 'Remarks from AM');
INSERT INTO public.collection VALUES (411, 'Jan/21', 'Others', 'RM-West', 'Metal', '12505', '1112759', 'Client_33', 'DAYS 151-180', '-0.083526662', '-0.003177354', '-0.050640062', '0', '-0.051081516', 'Remarks from AM');
INSERT INTO public.collection VALUES (412, 'Jan/21', 'Others', 'RM-West', 'Metal', '12505', '1112759', 'Client_33', 'DAYS ABOVE 180', '0.008957186', '0.572333388', '0.455815779', '0', '0.454794023', 'Remarks from AM');
INSERT INTO public.collection VALUES (413, 'Jan/21', 'Others', 'RM-West', 'Metal', '14316', '1110744', 'Client_9', 'ADVANCE', '-0.125709369', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (414, 'Jan/21', 'Others', 'RM-West', 'Metal', '14317', '1110745', 'Client_535', 'ADVANCE', '-0.119630141', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (415, 'Jan/21', 'Others', 'RM-West', 'Metal', '14327', '1111277', 'Client_274', 'WITHIN CR PD', '0.076483826', '0.992498322', '0.825565585', '0', '0.824120167', 'Remarks from AM');
INSERT INTO public.collection VALUES (416, 'Jan/21', 'Others', 'RM-West', 'Metal', '14332', '1111603', 'Client_288', 'WITHIN CR PD', '-0.10729316', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (417, 'Jan/21', 'Others', 'RM-West', 'Metal', '14332', '1111605', 'Client_23', 'ADVANCE', '-0.112389422', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (418, 'Jan/21', 'Others', 'RM-West', 'Metal', '14332', '1111605', 'Client_23', 'DAYS UPTO 60', '-0.102512868', '-0.121320259', '-0.154607129', '0', '-0.154929458', 'Remarks from AM');
INSERT INTO public.collection VALUES (419, 'Jan/21', 'Others', 'RM-West', 'Metal', '14332', '1111605', 'Client_23', 'WITHIN CR PD', '-0.102132726', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (420, 'Jan/21', 'Others', 'RM-West', 'Metal', '14332', '1111607', 'Client_525', 'DAYS UPTO 60', '-0.093259542', '-0.063740836', '-0.103936598', '0', '-0.104316985', 'Remarks from AM');
INSERT INTO public.collection VALUES (421, 'Jan/21', 'Others', 'RM-West', 'Metal', '14332', '1111607', 'Client_525', 'WITHIN CR PD', '-0.097736074', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (422, 'Jan/21', 'Others', 'RM-West', 'Metal', '14332', '1111839', 'Client_115', 'DAYS UPTO 60', '-0.111791618', '-0.179057881', '-0.205416878', '0', '-0.205680988', 'Remarks from AM');
INSERT INTO public.collection VALUES (423, 'Jan/21', 'Others', 'RM-West', 'Metal', '14332', '1111893', 'Client_193', 'ADVANCE', '-0.11233582', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (424, 'Jan/21', 'Others', 'RM-West', 'Metal', '14332', '1111895', 'Client_253', 'DAYS UPTO 60', '-0.111405377', '-0.176654474', '-0.203301853', '0', '-0.203568386', 'Remarks from AM');
INSERT INTO public.collection VALUES (425, 'Jan/21', 'Others', 'RM-West', 'Metal', '14332', '1112170', 'Client_213', 'DAYS  91-150', '-0.105777312', '-0.14163347', '-0.172482981', '0', '-0.172784827', 'Remarks from AM');
INSERT INTO public.collection VALUES (426, 'Jan/21', 'Others', 'RM-West', 'Metal', '14332', '1112361', 'Client_222', 'DAYS  91-150', '-0.112258937', '-0.181965804', '-0.207975883', '0', '-0.208237061', 'Remarks from AM');
INSERT INTO public.collection VALUES (427, 'Jan/21', 'Others', 'RM-West', 'Metal', '14332', '1112361', 'Client_222', 'DAYS UPTO 60', '-0.086006768', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (428, 'Jan/21', 'Others', 'RM-West', 'Metal', '14332', '1112576', 'Client_222', 'DAYS UPTO 60', '-0.059712022', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (429, 'Jan/21', 'Others', 'RM-West', 'Metal', '14332', '1112607', 'Client_167', 'DAYS 61-90', '-0.051264284', '0.197577395', '0.126026346', '0', '0.125382466', 'Remarks from AM');
INSERT INTO public.collection VALUES (430, 'Jan/21', 'Others', 'RM-West', 'Metal', '14332', '1112607', 'Client_167', 'DAYS UPTO 60', '-0.019235553', '0.396878256', '0.301413316', '0', '0.300568475', 'Remarks from AM');
INSERT INTO public.collection VALUES (431, 'Jan/21', 'Others', 'RM-West', 'Metal', '14332', '1112607', 'Client_167', 'WITHIN CR PD', '-0.022494637', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (432, 'Jan/21', 'Others', 'RM-West', 'Metal', '14332', '1112649', 'Client_166', 'DAYS 61-90', '-0.085069208', '-0.012775944', '-0.059086928', '0', '-0.059518704', 'Remarks from AM');
INSERT INTO public.collection VALUES (433, 'Jan/21', 'Others', 'RM-West', 'Metal', '14332', '1112649', 'Client_166', 'DAYS UPTO 60', '-0.054410996', '0.177996776', '0.108795183', '0', '0.108171046', 'Remarks from AM');
INSERT INTO public.collection VALUES (434, 'Jan/21', 'Others', 'RM-West', 'Metal', '14332', '1112654', 'Client_39', 'WITHIN CR PD', '-0.098399739', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (435, 'Jan/21', 'Others', 'RM-West', 'Metal', '14332', '1112962', 'Client_285', 'DAYS UPTO 60', '-0.107541987', '-0.152614275', '-0.182146211', '0', '-0.182436985', 'Remarks from AM');
INSERT INTO public.collection VALUES (436, 'Jan/21', 'Others', 'RM-West', 'Metal', '14354', '1112609', 'Client_183', 'DAYS 61-90', '-0.073743688', '0.05769784', '0.002930784', '0', '0.002427948', 'Remarks from AM');
INSERT INTO public.collection VALUES (437, 'Jan/21', 'Others', 'RM-West', 'Metal', '14354', '1112609', 'Client_183', 'DAYS UPTO 60', '-0.044412691', '0.240210627', '0.163544063', '0', '0.162857195', 'Remarks from AM');
INSERT INTO public.collection VALUES (438, 'Jan/21', 'Others', 'RM-West', 'Metal', '14354', '1112609', 'Client_183', 'WITHIN CR PD', '0.096701069', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (439, 'Jan/21', 'Others', 'RM-West', 'Metal', '14355', '1112961', 'Client_424', 'WITHIN CR PD', '-0.101938298', '-0.117744958', '-0.151460825', '0', '-0.151786758', 'Remarks from AM');
INSERT INTO public.collection VALUES (440, 'Jan/21', 'Others', 'RM-West', 'MSS/CMS', '53302', '1110893', 'Client_455', 'DAYS UPTO 60', '0.194818326', '0.773223094', '0.63260095', '0', '0.631376632', 'Remarks from AM');
INSERT INTO public.collection VALUES (441, 'Jan/21', 'Others', 'RM-West', 'MSS/CMS', '53302', '1112871', 'Client_453', 'DAYS UPTO 60', '-0.059726657', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (442, 'Jan/21', 'Others', 'RM-West', 'OVC', '50056', '1112864', 'Client_542', 'DAYS UPTO 60', '-0.037309617', '0.284411219', '0.202441075', '0', '0.201709638', 'Remarks from AM');
INSERT INTO public.collection VALUES (443, 'Jan/21', 'Others', 'RM-West', 'RA/AS', '50033', '1112340', 'Client_4', 'DAYS ABOVE 180', '0.047084564', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (444, 'Jan/21', 'Others', 'RM-West', 'RA/AS', '50034', '1112341', 'Client_25', 'DAYS ABOVE 180', '-0.057963952', '0.155888275', '0.089339457', '0', '0.088737613', 'Remarks from AM');
INSERT INTO public.collection VALUES (445, 'Jan/21', 'Others', 'RM-West', 'RA/AS', '50036', '1113182', 'Client_121', 'DAYS UPTO 60', '-0.108539301', '-0.158820127', '-0.187607429', '0', '-0.187891946', 'Remarks from AM');
INSERT INTO public.collection VALUES (446, 'Jan/21', 'Others', 'RM-West', 'RA/AS', '50111', '1113059', 'Client_548', 'DAYS UPTO 60', '-0.102982375', '-0.124241795', '-0.157178114', '0', '-0.157497496', 'Remarks from AM');
INSERT INTO public.collection VALUES (447, 'Jan/21', 'Others', 'RM-West', 'RA/AS', '50111', '1113149', 'Client_532', 'DAYS UPTO 60', '-0.107655244', '-0.153319028', '-0.182766402', '0', '-0.183056465', 'Remarks from AM');
INSERT INTO public.collection VALUES (448, 'Jan/21', 'Others', 'RM-West', 'StraightLine', '61186', '1112978', 'Client_24', 'DAYS 61-90', '-0.087071835', '-0.025237424', '-0.070053168', '0', '-0.070472379', 'Remarks from AM');
INSERT INTO public.collection VALUES (449, 'Jan/21', 'Others', 'RM-West', 'StraightLine', '61186', '1112978', 'Client_24', 'DAYS UPTO 60', '-0.081507434', '-0.064515585', '-0.104618386', '0', '-0.104997992', 'Remarks from AM');
INSERT INTO public.collection VALUES (450, 'Jan/21', 'Others', 'RM-West', 'StraightLine', '61186', '1112978', 'Client_24', 'WITHIN CR PD', '-0.069608226', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (451, 'Jan/21', 'Others', 'RM-West', 'StraightLine', '61186', '1112979', 'Client_24', 'DAYS UPTO 60', '-0.061062646', '-0.064515585', '-0.104618386', '0', '-0.104997992', 'Remarks from AM');
INSERT INTO public.collection VALUES (452, 'Jan/21', 'Others', 'RM-West', 'StraightLine', '61186', '1112979', 'Client_24', 'WITHIN CR PD', '-0.068582207', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (453, 'Jan/21', 'Others', 'RM-West', 'StraightLine', '61186', '1112980', 'Client_24', 'DAYS UPTO 60', '-0.093384049', '-0.064515585', '-0.104618386', '0', '-0.104997992', 'Remarks from AM');
INSERT INTO public.collection VALUES (454, 'Jan/21', 'Others', 'RM-West', 'Value', '84030', '1007903', 'Client_82', 'DAYS UPTO 60', '-0.093698621', '-0.06647303', '-0.10634096', '0', '-0.106718592', 'Remarks from AM');
INSERT INTO public.collection VALUES (455, 'Jan/21', 'Others', 'RM-West', 'Value', '84270', '1111953', 'Client_234', 'DAYS UPTO 60', '0.081557383', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (456, 'Jan/21', 'Others', 'RM-West', 'Value', '84297', '1112260', 'Client_137', 'DAYS UPTO 60', '-0.111640697', '-0.178118765', '-0.204590446', '0', '-0.204855502', 'Remarks from AM');
INSERT INTO public.collection VALUES (457, 'Jan/21', 'Others', 'RM-West', 'Value', '84308', '1112364', 'Client_5', 'DAYS UPTO 60', '-0.104980631', '-0.136676075', '-0.168120418', '0', '-0.168427263', 'Remarks from AM');
INSERT INTO public.collection VALUES (458, 'Jan/21', 'Others', 'RM-West', 'Value', '84308', '1112412', 'Client_26', 'DAYS ABOVE 180', '-0.107508611', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (459, 'Jan/21', 'Others', 'RM-West', 'Value', '84308', '1112453', 'Client_1', 'DAYS ABOVE 180', '-0.11061428', '-0.171731817', '-0.19896986', '0', '-0.199241357', 'Remarks from AM');
INSERT INTO public.collection VALUES (460, 'Jan/21', 'Others', 'RM-West', 'Value', '84308', '1112461', 'Client_3', 'DAYS ABOVE 180', '-0.107190526', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (461, 'Jan/21', 'Others', 'RM-West', 'Value', '84308', '1112533', 'Client_6', 'DAYS UPTO 60', '-0.077532696', '0.034120492', '-0.017817543', '0', '-0.018296606', 'Remarks from AM');
INSERT INTO public.collection VALUES (462, 'Jan/21', 'Others', 'RM-West', 'Value', '84308', '1112533', 'Client_6', 'WITHIN CR PD', '-0.082218216', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (463, 'Jan/21', 'Others', 'RM-West', 'Value', '84308', '1112616', 'Client_2', 'DAYS ABOVE 180', '-0.108326179', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (464, 'Jan/21', 'Others', 'RM-West', 'Value', '84316', '1112536', 'Client_159', 'DAYS  91-150', '-0.109885592', '-0.167197513', '-0.194979623', '0', '-0.195255692', 'Remarks from AM');
INSERT INTO public.collection VALUES (465, 'Jan/21', 'Others', 'RM-West', 'Value', '84319', '1112600', 'Client_17', 'DAYS 61-90', '-0.078257207', '0.029611803', '-0.02178524', '0', '-0.022259757', 'Remarks from AM');
INSERT INTO public.collection VALUES (466, 'Jan/21', 'Others', 'RM-West', 'Value', '84319', '1112604', 'Client_16', 'DAYS  91-150', '-0.108177977', '-0.156573068', '-0.185629993', '0', '-0.185916775', 'Remarks from AM');
INSERT INTO public.collection VALUES (467, 'Jan/21', 'Others', 'RM-West', 'Value', '84319', '1112604', 'Client_16', 'DAYS UPTO 60', '-0.097324414', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (468, 'Jan/21', 'Others', 'RM-West', 'Value', '84319', '1112618', 'Client_141', 'DAYS UPTO 60', '-0.101056875', '-0.112260243', '-0.146634215', '0', '-0.146965678', 'Remarks from AM');
INSERT INTO public.collection VALUES (469, 'Jan/21', 'Others', 'RM-West', 'Value', '84319', '1112691', 'Client_14', 'DAYS 61-90', '-0.099045944', '-0.099747096', '-0.135622507', '0', '-0.135966587', 'Remarks from AM');
INSERT INTO public.collection VALUES (470, 'Jan/21', 'Others', 'RM-West', 'Value', '84319', '1112908', 'Client_18', 'DAYS UPTO 60', '-0.104657501', '-0.134665377', '-0.166350982', '0', '-0.166659854', 'Remarks from AM');
INSERT INTO public.collection VALUES (471, 'Jan/21', 'Others', 'RM-West', 'Value', '84319', '1112909', 'Client_18', 'WITHIN CR PD', '-0.089489012', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (472, 'Jan/21', 'Others', 'RM-West', 'Value', '84319', '1113046', 'Client_13', 'DAYS 61-90', '-0.089176026', '-0.038331423', '-0.081576033', '0', '-0.08198204', 'Remarks from AM');
INSERT INTO public.collection VALUES (473, 'Jan/21', 'Others', 'RM-West', 'Value', '84319', '1113046', 'Client_13', 'DAYS UPTO 60', '-0.103017733', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (474, 'Jan/21', 'Others', 'RM-West', 'Value', '84325', '1112676', 'Client_184', 'DAYS UPTO 60', '-0.000689635', '0.139711636', '0.075103835', '0', '0.074518302', 'Remarks from AM');
INSERT INTO public.collection VALUES (475, 'Jan/21', 'Others', 'RM-West', 'Value', '84325', '1112676', 'Client_184', 'WITHIN CR PD', '-0.03337806', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (476, 'Jan/21', 'Others', 'SP', 'Coal', '20630', '1106161', 'Client_437', 'DAYS 61-90', '-0.072839906', '-0.182396262', '0.007879826', '0', '0.007371319', 'Remarks from AM');
INSERT INTO public.collection VALUES (477, 'Jan/21', 'Others', 'SP', 'Coal', '20630', '1106161', 'Client_437', 'DAYS UPTO 60', '0.680796738', '-0.182396262', '3.70226955', '0', '3.69752798', 'Remarks from AM');
INSERT INTO public.collection VALUES (478, 'Jan/21', 'Others', 'SP', 'Coal', '20934', '1112024', 'Client_175', 'DAYS 61-90', '-0.099319903', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (479, 'Jan/21', 'Others', 'SP', 'Coal', '20934', '1112024', 'Client_175', 'DAYS UPTO 60', '0.515857079', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (480, 'Jan/21', 'Others', 'SP', 'Coal', '20934', '1112024', 'Client_175', 'WITHIN CR PD', '0.527880246', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (481, 'Jan/21', 'Others', 'SP', 'Coal', '20934', '1112658', 'Client_428', 'ADVANCE', '-0.112422299', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (482, 'Jan/21', 'Others', 'SP', 'Coal', '20934', '1112658', 'Client_428', 'DAYS UPTO 60', '-0.110509484', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (483, 'Jan/21', 'Others', 'SP', 'Coal', '20934', '1112659', 'Client_241', 'DAYS UPTO 60', '-0.097779072', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (484, 'Jan/21', 'Others', 'SP', 'Coal', '20934', '1112841', 'Client_57', 'DAYS UPTO 60', '-0.103664361', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (485, 'Jan/21', 'Others', 'SP', 'Conference', '40006', '1010102', 'Client_445', 'ADVANCE', '-0.113612459', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (486, 'Jan/21', 'Others', 'SP', 'Conference', '40006', '1010149', 'Client_229', 'DAYS UPTO 60', '-0.107276363', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (487, 'Jan/21', 'Others', 'SP', 'Conference', '40006', '1010161', 'Client_531', 'DAYS UPTO 60', '-0.111946022', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (488, 'Jan/21', 'Others', 'SP', 'Conference', '40006', '1011410', 'Client_168', 'DAYS UPTO 60', '-0.108791888', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (489, 'Jan/21', 'Others', 'SP', 'Conference', '40006', '1107597', 'Client_90', 'DAYS UPTO 60', '-0.094646987', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (490, 'Jan/21', 'Others', 'SP', 'Conference', '40006', '1107597', 'Client_90', 'WITHIN CR PD', '-0.099951325', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (491, 'Jan/21', 'Others', 'SP', 'Conference', '40006', '1112212', 'Client_405', 'DAYS ABOVE 180', '-0.103234963', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (492, 'Jan/21', 'Others', 'SP', 'Conference', '40006', '1112728', 'Client_408', 'DAYS ABOVE 180', '-0.109297063', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (493, 'Jan/21', 'Others', 'SP', 'Conference', '40006', '1113213', 'Client_143', 'DAYS UPTO 60', '-0.110560001', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (494, 'Jan/21', 'Others', 'SP', 'Conference', '40006', '1113216', 'Client_533', 'DAYS UPTO 60', '-0.109802238', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (495, 'Jan/21', 'Others', 'SP', 'Conference', '40006', '1113218', 'Client_203', 'DAYS UPTO 60', '-0.110054826', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (496, 'Jan/21', 'Others', 'SP', 'Conference', '40006', '1113219', 'Client_22', 'DAYS UPTO 60', '-0.110560001', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (497, 'Jan/21', 'Others', 'SP', 'Conference', '40006', '1113228', 'Client_91', 'DAYS UPTO 60', '-0.109802238', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (498, 'Jan/21', 'Others', 'SP', 'Conference', '40006', '3000196', 'Client_34', 'WITHIN CR PD', '-0.108790912', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (499, 'Jan/21', 'Others', 'SP', 'Conference', '40007', '1113224', 'Client_19', 'WITHIN CR PD', '-0.069516668', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (500, 'Jan/21', 'Others', 'SP', 'Content', '40002', '1006980', 'Client_56', 'DAYS ABOVE 180', '-0.110512909', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (501, 'Jan/21', 'Others', 'SP', 'Content', '40002', '1107550', 'Client_187', 'DAYS  91-150', '-0.10333771', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (502, 'Jan/21', 'Others', 'SP', 'Content', '40002', '1107550', 'Client_187', 'DAYS 61-90', '-0.107832912', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (503, 'Jan/21', 'Others', 'SP', 'Content', '40002', '1107550', 'Client_187', 'DAYS UPTO 60', '-0.107832912', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (504, 'Jan/21', 'Others', 'SP', 'Content', '40002', '1107686', 'Client_403', 'DAYS 151-180', '-0.105585311', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (505, 'Jan/21', 'Others', 'SP', 'Content', '40002', '1107686', 'Client_403', 'DAYS UPTO 60', '-0.108956712', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (506, 'Jan/21', 'Others', 'SP', 'Content', '40002', '1107686', 'Client_403', 'WITHIN CR PD', '-0.105585311', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (507, 'Jan/21', 'Others', 'SP', 'Content', '40002', '1109209', 'Client_286', 'DAYS  91-150', '-0.096145387', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (508, 'Jan/21', 'Others', 'SP', 'Content', '40002', '1109209', 'Client_286', 'DAYS 151-180', '-0.106933872', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (509, 'Jan/21', 'Others', 'SP', 'Content', '40002', '1109209', 'Client_286', 'DAYS ABOVE 180', '-0.106933872', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (510, 'Jan/21', 'Others', 'SP', 'Content', '40002', '1109209', 'Client_286', 'DAYS UPTO 60', '-0.10221391', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (511, 'Jan/21', 'Others', 'SP', 'Content', '40002', '1109350', 'Client_554', 'DAYS 61-90', '-0.108282432', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (512, 'Jan/21', 'Others', 'SP', 'Content', '40002', '1109824', 'Client_204', 'DAYS  91-150', '-0.107608152', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (513, 'Jan/21', 'Others', 'SP', 'Content', '40002', '1109824', 'Client_204', 'DAYS UPTO 60', '-0.10288819', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (514, 'Jan/21', 'Others', 'SP', 'Content', '40002', '1110611', 'Client_142', 'ADVANCE', '-0.113318129', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (515, 'Jan/21', 'Others', 'SP', 'Content', '40002', '1110863', 'Client_212', 'DAYS 61-90', '-0.108956712', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (516, 'Jan/21', 'Others', 'SP', 'Content', '40002', '1110863', 'Client_212', 'DAYS UPTO 60', '-0.108956712', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (517, 'Jan/21', 'Others', 'SP', 'Content', '40002', '1111636', 'Client_8', 'ADVANCE', '-0.114679832', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (518, 'Jan/21', 'Others', 'SP', 'Content', '40002', '1112276', 'Client_189', 'DAYS ABOVE 180', '-0.109293853', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (519, 'Jan/21', 'Others', 'SP', 'Content', '40002', '1113025', 'Client_196', 'DAYS  91-150', '-0.104686271', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (520, 'Jan/21', 'Others', 'SP', 'Content', '40002', '1113025', 'Client_196', 'DAYS 61-90', '-0.108507192', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (521, 'Jan/21', 'Others', 'SP', 'Content', '40002', '1113098', 'Client_131', 'DAYS UPTO 60', '-0.10322533', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (522, 'Jan/21', 'Others', 'SP', 'Content', '40004', '1009433', 'Client_85', 'WITHIN CR PD', '-0.09948468', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (523, 'Jan/21', 'Others', 'SP', 'Content', '40004', '1009739', 'Client_15', 'DAYS ABOVE 180', '-0.109802238', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (524, 'Jan/21', 'Others', 'SP', 'Content', '40004', '1009772', 'Client_442', 'DAYS ABOVE 180', '-0.1122746', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (525, 'Jan/21', 'Others', 'SP', 'Content', '40004', '1010186', 'Client_278', 'DAYS ABOVE 180', '-0.112212523', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (526, 'Jan/21', 'Others', 'SP', 'Content', '40004', '1010502', 'Client_524', 'ADVANCE', '-0.112393787', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (527, 'Jan/21', 'Others', 'SP', 'Content', '40004', '1010503', 'Client_86', 'ADVANCE', '-0.11236095', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (528, 'Jan/21', 'Others', 'SP', 'Content', '40004', '1109639', 'Client_519', 'ADVANCE', '-0.13730146', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (529, 'Jan/21', 'Others', 'SP', 'Content', '40004', '1109639', 'Client_519', 'DAYS UPTO 60', '-0.107547503', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (530, 'Jan/21', 'Others', 'SP', 'Content', '40004', '1109639', 'Client_519', 'WITHIN CR PD', '-0.109830781', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (531, 'Jan/21', 'Others', 'SP', 'Content', '40004', '1110051', 'Client_136', 'ADVANCE', '-0.113184368', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (532, 'Jan/21', 'Others', 'SP', 'Content', '40004', '1110051', 'Client_136', 'DAYS ABOVE 180', '-0.112256762', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (533, 'Jan/21', 'Others', 'SP', 'Content', '40004', '1110093', 'Client_474', 'ADVANCE', '-0.112367389', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (534, 'Jan/21', 'Others', 'SP', 'Content', '40004', '1110145', 'Client_105', 'ADVANCE', '-0.112435209', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (535, 'Jan/21', 'Others', 'SP', 'Content', '40004', '1110780', 'Client_405', 'ADVANCE', '-0.112613255', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (536, 'Jan/21', 'Others', 'SP', 'Content', '40004', '1111556', 'Client_225', 'ADVANCE', '-0.112924666', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (537, 'Jan/21', 'Others', 'SP', 'Content', '40004', '1111556', 'Client_225', 'DAYS UPTO 60', '-0.112159724', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (538, 'Jan/21', 'Others', 'SP', 'Content', '40004', '1111587', 'Client_226', 'ADVANCE', '-0.112773353', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (539, 'Jan/21', 'Others', 'SP', 'Content', '40004', '1112750', 'Client_149', 'DAYS ABOVE 180', '-0.108286713', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (540, 'Jan/21', 'Others', 'SP', 'Content', '40004', '1112999', 'Client_29', 'ADVANCE', '-0.112957442', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (541, 'Jan/21', 'Others', 'SP', 'Content', '40004', '1113063', 'Client_185', 'DAYS 61-90', '-0.109652398', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (542, 'Jan/21', 'Others', 'SP', 'Content', '40008', '1109362', 'Client_419', 'ADVANCE', '-0.113998402', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (543, 'Jan/21', 'Others', 'SP', 'Content', '40008', '1109362', 'Client_419', 'DAYS ABOVE 180', '-0.095471107', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (544, 'Jan/21', 'Others', 'SP', 'Content', '40008', '1111874', 'Client_108', 'DAYS UPTO 60', '-0.106709112', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (545, 'Jan/21', 'Others', 'SP', 'Content', '40008', '1111933', 'Client_105', 'DAYS 61-90', '-0.108282432', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (546, 'Jan/21', 'Others', 'SP', 'Content', '40008', '1111933', 'Client_105', 'DAYS ABOVE 180', '-0.111795743', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (547, 'Jan/21', 'Others', 'SP', 'Content', '40008', '1111933', 'Client_105', 'DAYS UPTO 60', '-0.10423675', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (548, 'Jan/21', 'Others', 'SP', 'Content', '40008', '1112455', 'Client_434', 'DAYS  91-150', '-0.101090109', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (549, 'Jan/21', 'Others', 'SP', 'Content', '40008', '1112455', 'Client_434', 'DAYS 151-180', '-0.106709112', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (550, 'Jan/21', 'Others', 'SP', 'Content', '40008', '1112455', 'Client_434', 'DAYS 61-90', '-0.106709112', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (551, 'Jan/21', 'Others', 'SP', 'Content', '40008', '1112455', 'Client_434', 'DAYS UPTO 60', '-0.106709112', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (552, 'Jan/21', 'Others', 'SP', 'Content', '40008', '1113052', 'Client_205', 'DAYS UPTO 60', '-0.101090109', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (553, 'Jan/21', 'Others', 'SP', 'Content', '40009', '1010279', 'Client_178', 'DAYS ABOVE 180', '-0.111257828', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (554, 'Jan/21', 'Others', 'SP', 'Content', '40009', '1110078', 'Client_283', 'DAYS ABOVE 180', '-0.10606908', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (555, 'Jan/21', 'Others', 'SP', 'Content', '40009', '1110080', 'Client_124', 'ADVANCE', '-0.112369864', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (556, 'Jan/21', 'Others', 'SP', 'Content', '40009', '1110149', 'Client_125', 'ADVANCE', '-0.112479397', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (557, 'Jan/21', 'Others', 'SP', 'Content', '40009', '1110158', 'Client_247', 'ADVANCE', '-0.114377581', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (558, 'Jan/21', 'Others', 'SP', 'Content', '40009', '1110168', 'Client_444', 'ADVANCE', '-0.112360274', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (559, 'Jan/21', 'Others', 'SP', 'Content', '40009', '1110331', 'Client_431', 'DAYS ABOVE 180', '-0.110615656', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (560, 'Jan/21', 'Others', 'SP', 'Content', '40009', '1110346', 'Client_80', 'DAYS ABOVE 180', '-0.1122746', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (561, 'Jan/21', 'Others', 'SP', 'Content', '40009', '1111651', 'Client_48', 'ADVANCE', '-0.112970313', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (562, 'Jan/21', 'Others', 'SP', 'Content', '40009', '1112998', 'Client_29', 'DAYS 151-180', '-0.111570351', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (563, 'Jan/21', 'Others', 'SP', 'Content', '40011', '1010631', 'Client_438', 'DAYS UPTO 60', '-0.107276363', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (564, 'Jan/21', 'Others', 'SP', 'Content', '40011', '1110011', 'Client_215', 'WITHIN CR PD', '-0.112299574', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (565, 'Jan/21', 'Others', 'SP', 'Content', '40011', '1110024', 'Client_122', 'ADVANCE', '-0.112718837', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (566, 'Jan/21', 'Others', 'SP', 'Content', '40011', '1111659', 'Client_188', 'DAYS ABOVE 180', '-0.111380911', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (567, 'Jan/21', 'Others', 'SP', 'Content', '40011', '1112678', 'Client_96', 'DAYS ABOVE 180', '-0.10348755', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (568, 'Jan/21', 'Others', 'SP', 'Content', '40011', '1112835', 'Client_164', 'DAYS ABOVE 180', '-0.095909924', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (569, 'Jan/21', 'Others', 'SP', 'Content', '40011', '1112917', 'Client_163', 'ADVANCE', '-0.114641002', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (570, 'Jan/21', 'Others', 'SP', 'Content', '40012', '1009683', 'Client_218', 'ADVANCE', '-0.112547938', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (571, 'Jan/21', 'Others', 'SP', 'Content', '40012', '1009699', 'Client_120', 'ADVANCE', '-0.114222531', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (572, 'Jan/21', 'Others', 'SP', 'Content', '40012', '1010495', 'Client_530', 'DAYS  91-150', '-0.093384049', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (573, 'Jan/21', 'Others', 'SP', 'Content', '40012', '1110017', 'Client_441', 'DAYS ABOVE 180', '-0.112297521', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (574, 'Jan/21', 'Others', 'SP', 'Content', '40012', '1110128', 'Client_107', 'ADVANCE', '-0.113361041', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (575, 'Jan/21', 'Others', 'SP', 'Content', '40012', '1110233', 'Client_552', 'ADVANCE', '-0.113135957', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (576, 'Jan/21', 'Others', 'SP', 'Content', '40012', '1110233', 'Client_552', 'DAYS ABOVE 180', '-0.074439984', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (577, 'Jan/21', 'Others', 'SP', 'Content', '40012', '1112059', 'Client_149', 'DAYS ABOVE 180', '-0.074439984', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (578, 'Jan/21', 'Others', 'SP', 'Content', '40012', '1112836', 'Client_164', 'DAYS ABOVE 180', '-0.107276363', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (579, 'Jan/21', 'Others', 'SP', 'Content', '40012', '1113056', 'Client_35', 'DAYS  91-150', '-0.111065176', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (580, 'Jan/21', 'Others', 'SP', 'Content', '40012', '1113057', 'Client_194', 'DAYS  91-150', '-0.111065176', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (581, 'Jan/21', 'Others', 'SP', 'EPS', '50241', '1108679', 'Client_526', 'ADVANCE', '-0.112706567', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (582, 'Jan/21', 'Others', 'SP', 'FJ', '30002', '1108663', 'Client_40', 'DAYS  91-150', '-0.059639528', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (583, 'Jan/21', 'Others', 'SP', 'FJ', '30002', '1108663', 'Client_40', 'DAYS 151-180', '-0.083592859', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (584, 'Jan/21', 'Others', 'SP', 'FJ', '30002', '1108663', 'Client_40', 'DAYS 61-90', '-0.096577143', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (585, 'Jan/21', 'Others', 'SP', 'FJ', '30002', '1108663', 'Client_40', 'DAYS ABOVE 180', '0.16111294', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (586, 'Jan/21', 'Others', 'SP', 'FJ', '30002', '1108663', 'Client_40', 'DAYS UPTO 60', '-0.081589286', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (587, 'Jan/21', 'Others', 'SP', 'FJ', '30008', '1220003', 'Client_42', 'DAYS UPTO 60', '-0.105038789', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (588, 'Jan/21', 'Others', 'SP', 'FJ', '30008', '1220006', 'Client_41', 'ADVANCE', '-0.11249936', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (589, 'Jan/21', 'Others', 'SP', 'FJ', '30008', '1220041', 'Client_451', 'ADVANCE', '-0.1126492', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (590, 'Jan/21', 'Others', 'SP', 'FJ', '30008', '1220042', 'Client_527', 'ADVANCE', '-0.112858976', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (591, 'Jan/21', 'Others', 'SP', 'FJ', '30008', '1220046', 'Client_199', 'ADVANCE', '-0.112863253', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (592, 'Jan/21', 'Others', 'SP', 'FJ', '30008', '1220115', 'Client_545', 'ADVANCE', '-0.115362947', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (593, 'Jan/21', 'Others', 'SP', 'FJ', '30008', '1220119', 'Client_238', 'ADVANCE', '-0.112370934', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (594, 'Jan/21', 'Others', 'SP', 'FJ', '30008', '1220119', 'Client_238', 'DAYS UPTO 60', '-0.111215016', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (595, 'Jan/21', 'Others', 'SP', 'FJ', '30008', '1220122', 'Client_127', 'ADVANCE', '-0.112343569', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (596, 'Jan/21', 'Others', 'SP', 'FJ', '30008', '1220122', 'Client_127', 'DAYS UPTO 60', '-0.108351772', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (597, 'Jan/21', 'Others', 'SP', 'FJ', '30008', '1220152', 'Client_246', 'DAYS UPTO 60', '-0.110958148', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (598, 'Jan/21', 'Others', 'SP', 'FJ', '30008', '1220200', 'Client_28', 'ADVANCE', '-0.113744766', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (599, 'Jan/21', 'Others', 'SP', 'FJ', '30008', '1220226', 'Client_271', 'DAYS UPTO 60', '-0.111677382', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (600, 'Jan/21', 'Others', 'SP', 'FJ', '30008', '1220236', 'Client_160', 'ADVANCE', '-0.112403034', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (601, 'Jan/21', 'Others', 'SP', 'FJ', '30008', '1220242', 'Client_95', 'DAYS UPTO 60', '-0.109826898', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (602, 'Jan/21', 'Others', 'SP', 'FJ', '30008', '1220288', 'Client_435', 'DAYS UPTO 60', '-0.110943917', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (603, 'Jan/21', 'Others', 'SP', 'FJ', '30008', '1220345', 'Client_277', 'DAYS UPTO 60', '-0.108903198', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (604, 'Jan/21', 'Others', 'SP', 'FJ', '30008', '1235405', 'Client_30', 'DAYS UPTO 60', '-0.110754791', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (605, 'Jan/21', 'Others', 'SP', 'FJ', '30008', '1235445', 'Client_50', 'DAYS UPTO 60', '-0.108903198', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (606, 'Jan/21', 'Others', 'SP', 'FJ', '30008', '1235480', 'Client_413', 'DAYS UPTO 60', '-0.110187542', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (607, 'Jan/21', 'Others', 'SP', 'FJ', '30008', '1235544', 'Client_52', 'DAYS UPTO 60', '-0.111129395', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (608, 'Jan/21', 'Others', 'SP', 'FJ', '30008', '1235548', 'Client_110', 'ADVANCE', '-0.112370964', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (609, 'Jan/21', 'Others', 'SP', 'FJ', '30008', '1235548', 'Client_110', 'WITHIN CR PD', '-0.11066085', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (610, 'Jan/21', 'Others', 'SP', 'FJ', '30008', '1235905', 'Client_179', 'DAYS UPTO 60', '-0.110615656', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (611, 'Jan/21', 'Others', 'SP', 'FJ', '30008', '1236114', 'Client_450', 'DAYS UPTO 60', '-0.111899997', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (612, 'Jan/21', 'Others', 'SP', 'FJ', '30008', '1236139', 'Client_211', 'ADVANCE', '-0.114318846', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (613, 'Jan/21', 'Others', 'SP', 'FJ', '30008', '1236296', 'Client_429', 'ADVANCE', '-0.112756228', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (614, 'Jan/21', 'Others', 'SP', 'FJ', '30008', '1236309', 'Client_173', 'ADVANCE', '-0.112584982', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (615, 'Jan/21', 'Others', 'SP', 'FJ', '30008', '1236329', 'Client_119', 'ADVANCE', '-0.114040572', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (616, 'Jan/21', 'Others', 'SP', 'FJ', '30008', '1236381', 'Client_527', 'ADVANCE', '-0.112756228', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (617, 'Jan/21', 'Others', 'SP', 'FJ', '30013', '1109594', 'Client_156', 'ADVANCE', '-0.114202422', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (618, 'Jan/21', 'Others', 'SP', 'FJ', '30019', '1235569', 'Client_43', 'DAYS UPTO 60', '-0.110598193', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (619, 'Jan/21', 'Others', 'SP', 'FJ', '30019', '1235595', 'Client_63', 'DAYS 61-90', '-0.111643133', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (620, 'Jan/21', 'Others', 'SP', 'FJ', '30019', '1235595', 'Client_63', 'DAYS UPTO 60', '-0.10886227', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (621, 'Jan/21', 'Others', 'SP', 'FJ', '30019', '1236321', 'Client_102', 'DAYS 61-90', '-0.110779956', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (622, 'Jan/21', 'Others', 'SP', 'FJ', '30021', '1109725', 'Client_40', 'DAYS  91-150', '-0.086105955', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (623, 'Jan/21', 'Others', 'SP', 'FJ', '30021', '1109725', 'Client_40', 'DAYS 151-180', '-0.097867574', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (624, 'Jan/21', 'Others', 'SP', 'FJ', '30021', '1109725', 'Client_40', 'DAYS 61-90', '-0.094943914', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (625, 'Jan/21', 'Others', 'SP', 'FJ', '30021', '1109725', 'Client_40', 'DAYS ABOVE 180', '0.026469784', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (626, 'Jan/21', 'Others', 'SP', 'FJ', '30021', '1109725', 'Client_40', 'DAYS UPTO 60', '-0.070522538', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (627, 'Jan/21', 'Others', 'SP', 'FJ', '30021', '1109725', 'Client_40', 'WITHIN CR PD', '-0.090002458', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (628, 'Jan/21', 'Others', 'SP', 'FJ', '30022', '1236283', 'Client_10', 'DAYS UPTO 60', '-0.112007028', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (629, 'Jan/21', 'Others', 'SP', 'FJ', '30022', '1236285', 'Client_11', 'DAYS UPTO 60', '-0.111773746', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (630, 'Jan/21', 'Others', 'SP', 'FJ', '30022', '1236300', 'Client_266', 'DAYS UPTO 60', '-0.112255332', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (631, 'Jan/21', 'Others', 'SP', 'FJ', '30022', '1236331', 'Client_210', 'DAYS UPTO 60', '-0.112270271', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (632, 'Jan/21', 'Others', 'SP', 'FJ', '30022', '1236362', 'Client_44', 'DAYS 61-90', '-0.111403384', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (633, 'Jan/21', 'Others', 'SP', 'FJ', '30022', '1236362', 'Client_44', 'DAYS UPTO 60', '-0.111557508', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (634, 'Jan/21', 'Others', 'SP', 'FJ', '30022', '1236382', 'Client_59', 'DAYS UPTO 60', '-0.106334511', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (635, 'Jan/21', 'Others', 'SP', 'FJ', '30026', '1236356', 'Client_12', 'DAYS  91-150', '-0.112310989', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (636, 'Jan/21', 'Others', 'SP', 'FJ', '30100', '1011707', 'Client_300', 'ADVANCE', '-0.116609258', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (637, 'Jan/21', 'Others', 'SP', 'FJ', '30100', '1108663', 'Client_40', 'ADVANCE', '-0.244999069', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (638, 'Jan/21', 'Others', 'SP', 'FJ', '30100', '1109725', 'Client_40', 'ADVANCE', '-0.19907541', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (639, 'Jan/21', 'Others', 'SP', 'FJ', '30100', '1111828', 'Client_430', 'DAYS 61-90', '-0.100868252', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (640, 'Jan/21', 'Others', 'SP', 'FJ', '30100', '1220003', 'Client_42', 'ADVANCE', '-0.117042403', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (641, 'Jan/21', 'Others', 'SP', 'FJ', '30100', '1220007', 'Client_79', 'ADVANCE', '-0.112650396', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (642, 'Jan/21', 'Others', 'SP', 'FJ', '30100', '1220079', 'Client_112', 'ADVANCE', '-0.112884663', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (643, 'Jan/21', 'Others', 'SP', 'FJ', '30100', '1220145', 'Client_267', 'ADVANCE', '-0.112863257', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (644, 'Jan/21', 'Others', 'SP', 'FJ', '30100', '1220247', 'Client_37', 'ADVANCE', '-0.112419088', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (645, 'Jan/21', 'Others', 'SP', 'FJ', '30100', '1220302', 'Client_190', 'DAYS 61-90', '-0.110797712', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (646, 'Jan/21', 'Others', 'SP', 'FJ', '30100', '1233080', 'Client_129', 'DAYS 61-90', '-0.111618989', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (647, 'Jan/21', 'Others', 'SP', 'FJ', '30100', '1233080', 'Client_129', 'DAYS UPTO 60', '-0.111226196', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (648, 'Jan/21', 'Others', 'SP', 'FJ', '30100', '1235405', 'Client_30', 'ADVANCE', '-0.112756228', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (649, 'Jan/21', 'Others', 'SP', 'FJ', '30100', '1235484', 'Client_410', 'ADVANCE', '-0.114896801', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (650, 'Jan/21', 'Others', 'SP', 'FJ', '30100', '1235555', 'Client_92', 'DAYS 61-90', '-0.111257828', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (651, 'Jan/21', 'Others', 'SP', 'FJ', '30100', '1235569', 'Client_43', 'ADVANCE', '-0.11234246', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (652, 'Jan/21', 'Others', 'SP', 'FJ', '30100', '1235595', 'Client_63', 'ADVANCE', '-0.11289528', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (653, 'Jan/21', 'Others', 'SP', 'FJ', '30100', '1235876', 'Client_58', 'DAYS UPTO 60', '-0.112020462', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (654, 'Jan/21', 'Others', 'SP', 'FJ', '30100', '1235964', 'Client_202', 'ADVANCE', '-0.1133984', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (655, 'Jan/21', 'Others', 'SP', 'FJ', '30100', '1235964', 'Client_202', 'DAYS 61-90', '-0.111482588', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (656, 'Jan/21', 'Others', 'SP', 'FJ', '30100', '1235964', 'Client_202', 'DAYS UPTO 60', '-0.111483658', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (657, 'Jan/21', 'Others', 'SP', 'FJ', '30100', '1236291', 'Client_426', 'DAYS UPTO 60', '-0.111409808', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (658, 'Jan/21', 'Others', 'SP', 'FJ', '30100', '1236310', 'Client_198', 'DAYS UPTO 60', '-0.111566436', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (659, 'Jan/21', 'Others', 'SP', 'FJ', '30105', '1109624', 'Client_130', 'DAYS  91-150', '-0.110420551', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (660, 'Jan/21', 'Others', 'SP', 'FJ', '30105', '1109624', 'Client_130', 'DAYS 151-180', '-0.111643587', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (661, 'Jan/21', 'Others', 'SP', 'FJ', '30105', '1109624', 'Client_130', 'DAYS 61-90', '-0.110575454', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (662, 'Jan/21', 'Others', 'SP', 'FJ', '30105', '1109624', 'Client_130', 'DAYS ABOVE 180', '-0.107438071', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (663, 'Jan/21', 'Others', 'SP', 'FJ', '30105', '1109624', 'Client_130', 'DAYS UPTO 60', '-0.110626083', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (664, 'Jan/21', 'Others', 'SP', 'FJ', '30109', '1111850', 'Client_135', 'DAYS UPTO 60', '-0.038315536', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (665, 'Jan/21', 'Others', 'SP', 'FJ', '30109', '1111850', 'Client_135', 'WITHIN CR PD', '-0.074237749', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (666, 'Jan/21', 'Others', 'SP', 'FJ', '31001', '1236350', 'Client_219', 'DAYS  91-150', '-0.111752045', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (667, 'Jan/21', 'Others', 'SP', 'FJ', '31001', '1236350', 'Client_219', 'DAYS UPTO 60', '-0.108276635', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (668, 'Jan/21', 'Others', 'SP', 'FJ', '31002', '1011707', 'Client_300', 'DAYS UPTO 60', '-0.104707676', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (669, 'Jan/21', 'Others', 'SP', 'Metal', '10004', '1221357', 'Client_281', 'ADVANCE', '-0.112356241', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (670, 'Jan/21', 'Others', 'SP', 'Metal', '10004', '1233579', 'Client_165', 'DAYS 61-90', '-0.111444057', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (671, 'Jan/21', 'Others', 'SP', 'Metal', '10004', '1233580', 'Client_45', 'DAYS 61-90', '-0.111444057', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (672, 'Jan/21', 'Others', 'SP', 'Metal', '10004', '1233581', 'Client_299', 'DAYS 61-90', '-0.111444057', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (673, 'Jan/21', 'Others', 'SP', 'Metal', '10004', '1234022', 'Client_151', 'ADVANCE', '-0.114096227', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (674, 'Jan/21', 'Others', 'SP', 'Metal', '10004', '1234022', 'Client_151', 'DAYS UPTO 60', '-0.111444057', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (675, 'Jan/21', 'Others', 'SP', 'Metal', '10004', '1234039', 'Client_197', 'DAYS UPTO 60', '-0.111444057', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (676, 'Jan/21', 'Others', 'SP', 'Metal', '14229', '1010203', 'Client_547', 'ADVANCE', '-0.116284202', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (677, 'Jan/21', 'Others', 'SP', 'Metal', '14280', '1109051', 'Client_535', 'ADVANCE', '-0.117342837', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (678, 'Jan/21', 'Others', 'SP', 'MSS/CMS', '50012', '1109587', 'Client_440', 'ADVANCE', '-0.112416138', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (679, 'Jan/21', 'Others', 'SP', 'RA/AS', '50020', '1110430', 'Client_148', 'ADVANCE', '-0.140046385', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (680, 'Jan/21', 'Others', 'SP', 'RA/AS', '54059', '1112569', 'Client_186', 'ADVANCE', '-0.131593265', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (681, 'Jan/21', 'Others', 'SP', 'SAS', '50223', 'JSR_C1', 'Client_171', 'ADVANCE', '-0.148789124', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (682, 'Jan/21', 'Others', 'SP', 'SAS', '83124', '1010672', 'Client_534', 'ADVANCE', '-0.12144324', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (683, 'Jan/21', 'Others', 'SP', 'SAS', '83124', '1010672', 'Client_534', 'DAYS  91-150', '-0.07898757', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (684, 'Jan/21', 'Others', 'SP', 'SAS', '83124', '1010672', 'Client_534', 'DAYS 61-90', '-0.095277454', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (685, 'Jan/21', 'Others', 'SP', 'SAS', '83124', '1010672', 'Client_534', 'DAYS ABOVE 180', '-0.111906847', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (686, 'Jan/21', 'Others', 'SP', 'SAS', '83124', '1010672', 'Client_534', 'DAYS UPTO 60', '-0.050636387', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (687, 'Jan/21', 'Others', 'SP', 'SAS', '83124', '1111399', 'Client_534', 'DAYS 151-180', '-0.111927998', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (688, 'Jan/21', 'Others', 'SP', 'SAS', '83124', '1111399', 'Client_534', 'DAYS ABOVE 180', '-0.02159541', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (689, 'Jan/21', 'Others', 'SP', 'SAS', '83124', '1111399', 'Client_534', 'DAYS UPTO 60', '1.564616836', '8.87510209', '7.762344399', '0', '7.75295076', 'Remarks from AM');
INSERT INTO public.collection VALUES (690, 'Jan/21', 'Others', 'SP', 'SAS', '83127', '1010295', 'Client_544', 'DAYS 151-180', '-0.109766322', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (691, 'Jan/21', 'Others', 'SP', 'SAS', '83127', '1110730', 'Client_537', 'DAYS UPTO 60', '-0.111878594', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (692, 'Jan/21', 'Others', 'SP', 'SAS', '83127', '1110736', 'Client_539', 'DAYS  91-150', '-0.112071887', '-0.180801876', '-0.206951613', '0', '-0.207213964', 'Remarks from AM');
INSERT INTO public.collection VALUES (693, 'Jan/21', 'Others', 'SP', 'SAS', '83127', '1110736', 'Client_539', 'DAYS 151-180', '-0.11194317', '-0.180000927', '-0.206246769', '0', '-0.206509928', 'Remarks from AM');
INSERT INTO public.collection VALUES (694, 'Jan/21', 'Others', 'SP', 'SAS', '83127', '1110736', 'Client_539', 'DAYS ABOVE 180', '-0.111997759', '-0.180340609', '-0.206545693', '0', '-0.20680851', 'Remarks from AM');
INSERT INTO public.collection VALUES (695, 'Jan/21', 'Others', 'SP', 'SAS', '83127', '1110736', 'Client_539', 'DAYS UPTO 60', '-0.110474164', '-0.170859939', '-0.198202598', '0', '-0.198474975', 'Remarks from AM');
INSERT INTO public.collection VALUES (696, 'Jan/21', 'Others', 'SP', 'SAS', '83127', '1110737', 'Client_540', 'DAYS  91-150', '-0.078572003', '0.027653332', '-0.023508716', '0', '-0.023981258', 'Remarks from AM');
INSERT INTO public.collection VALUES (697, 'Jan/21', 'Others', 'SP', 'SAS', '83127', '1110737', 'Client_540', 'DAYS 61-90', '-0.073345723', '0.0601742', '0.005110009', '0', '0.004604675', 'Remarks from AM');
INSERT INTO public.collection VALUES (698, 'Jan/21', 'Others', 'SP', 'SAS', '83127', '1110737', 'Client_540', 'DAYS ABOVE 180', '-0.10648841', '-0.146058325', '-0.176376902', '0', '-0.176674286', 'Remarks from AM');
INSERT INTO public.collection VALUES (699, 'Jan/21', 'Others', 'SP', 'SAS', '83127', '1110737', 'Client_540', 'DAYS UPTO 60', '-0.061514305', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (700, 'Jan/21', 'Others', 'SP', 'SAS', '83127', '1110737', 'Client_540', 'WITHIN CR PD', '-0.035168182', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (701, 'Jan/21', 'Others', 'SP', 'SAS', '83127', '1110739', 'Client_425', 'DAYS ABOVE 180', '-0.112292152', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (702, 'Jan/21', 'Others', 'SP', 'SAS', '83127', '1110741', 'Client_538', 'DAYS UPTO 60', '-0.11212583', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (703, 'Jan/21', 'Others', 'SP', 'SAS', '83127', '1110790', 'Client_536', 'DAYS UPTO 60', '-0.10758452', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (704, 'Jan/21', 'Others', 'SP', 'SAS', '83127', '1112504', 'Client_535', 'DAYS 151-180', '-0.110889649', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (705, 'Jan/21', 'Others', 'SP', 'SAS', '83127', '1112504', 'Client_535', 'DAYS ABOVE 180', '-0.112165195', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (706, 'Jan/21', 'Others', 'SP', 'SAS', '83127', '1112615', 'Client_543', 'ADVANCE', '-0.113115919', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (707, 'Jan/21', 'Others', 'SP', 'SAS', '83138', '1111250', 'Client_535', 'DAYS 61-90', '-0.097804331', '-0.092021076', '-0.128823524', '0', '-0.129175395', 'Remarks from AM');
INSERT INTO public.collection VALUES (708, 'Jan/21', 'Others', 'SP', 'SAS', '83138', '1111250', 'Client_535', 'DAYS ABOVE 180', '-0.06374308', '0.119927276', '0.057693379', '0', '0.057127795', 'Remarks from AM');
INSERT INTO public.collection VALUES (709, 'Jan/21', 'Others', 'SP', 'SAS', '83138', '1111250', 'Client_535', 'DAYS UPTO 60', '-0.053202424', '0.18551719', '0.115413231', '0', '0.114781511', 'Remarks from AM');
INSERT INTO public.collection VALUES (710, 'Jan/21', 'Others', 'SP', 'SAS', '83138', '1111250', 'Client_535', 'WITHIN CR PD', '-0.021348625', '0.383729526', '0.289842287', '0', '0.289010705', 'Remarks from AM');
INSERT INTO public.collection VALUES (711, 'Jan/21', 'Others', 'SP', 'SAS', '83138', '1111251', 'Client_535', 'ADVANCE', '-0.120307848', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (712, 'Jan/21', 'Others', 'SP', 'SAS', '83138', '1111251', 'Client_535', 'DAYS  91-150', '-0.112185466', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (713, 'Jan/21', 'Others', 'SP', 'SAS', '83138', '1111251', 'Client_535', 'DAYS 151-180', '-0.112252179', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (714, 'Jan/21', 'Others', 'SP', 'SAS', '83138', '1111251', 'Client_535', 'DAYS 61-90', '-0.103560858', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (715, 'Jan/21', 'Others', 'SP', 'SAS', '83138', '1111251', 'Client_535', 'DAYS ABOVE 180', '0.118408193', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (716, 'Jan/21', 'Others', 'SP', 'SAS', '83138', '1111251', 'Client_535', 'DAYS UPTO 60', '0.012454597', '0.594072276', '0.474946242', '0', '0.473902566', 'Remarks from AM');
INSERT INTO public.collection VALUES (717, 'Jan/21', 'Others', 'SP', 'SAS', '83138', '1111251', 'Client_535', 'WITHIN CR PD', '0.026129431', '0.679164823', '0.549828628', '0', '0.548699151', 'Remarks from AM');
INSERT INTO public.collection VALUES (718, 'Jan/21', 'Others', 'SP', 'SAS', '83138', '1111252', 'Client_535', 'DAYS  91-150', '-0.110662913', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (719, 'Jan/21', 'Others', 'SP', 'SAS', '83138', '1111252', 'Client_535', 'DAYS 151-180', '-0.111406512', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (720, 'Jan/21', 'Others', 'SP', 'SAS', '83138', '1111252', 'Client_535', 'DAYS 61-90', '-0.106627363', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (721, 'Jan/21', 'Others', 'SP', 'SAS', '83138', '1111252', 'Client_535', 'DAYS ABOVE 180', '0.694057205', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (722, 'Jan/21', 'Others', 'SP', 'SAS', '83138', '1111252', 'Client_535', 'DAYS UPTO 60', '-0.083905571', '-0.00553514', '-0.05271494', '0', '-0.053154017', 'Remarks from AM');
INSERT INTO public.collection VALUES (723, 'Jan/21', 'Others', 'SP', 'SAS', '83138', '1111252', 'Client_535', 'WITHIN CR PD', '-0.024265812', '0.36557714', '0.273867986', '0', '0.273054708', 'Remarks from AM');
INSERT INTO public.collection VALUES (724, 'Jan/21', 'Others', 'SP', 'SAS', '83138', '1111253', 'Client_535', 'ADVANCE', '-0.112356547', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (725, 'Jan/21', 'Others', 'SP', 'SAS', '83138', '1111253', 'Client_535', 'DAYS 61-90', '0.035378255', '0.736716234', '0.600474508', '0', '0.599287001', 'Remarks from AM');
INSERT INTO public.collection VALUES (726, 'Jan/21', 'Others', 'SP', 'SAS', '83138', '1111253', 'Client_535', 'DAYS ABOVE 180', '-0.087465187', '-0.027685079', '-0.072207132', '0', '-0.072623875', 'Remarks from AM');
INSERT INTO public.collection VALUES (727, 'Jan/21', 'Others', 'SP', 'SAS', '83138', '1111253', 'Client_535', 'WITHIN CR PD', '-0.070852468', '0.075688642', '0.01876289', '0', '0.018241913', 'Remarks from AM');
INSERT INTO public.collection VALUES (728, 'Jan/21', 'Others', 'SP', 'SAS', '83138', '1112499', 'Client_541', 'DAYS  91-150', '-0.105662322', '-0.140917941', '-0.171853308', '0', '-0.172155875', 'Remarks from AM');
INSERT INTO public.collection VALUES (729, 'Jan/21', 'Others', 'SP', 'SAS', '83138', '1112499', 'Client_541', 'DAYS 151-180', '-0.102602989', '-0.121881038', '-0.155100621', '0', '-0.155422384', 'Remarks from AM');
INSERT INTO public.collection VALUES (730, 'Jan/21', 'Others', 'SP', 'SAS', '83138', '1112499', 'Client_541', 'DAYS 61-90', '0.272060655', '-0.182396262', '-0.20835469', '0', '', 'Remarks from AM');
INSERT INTO public.collection VALUES (731, 'Jan/21', 'Others', 'SP', 'SAS', '83138', '1112499', 'Client_541', 'DAYS ABOVE 180', '0.00595683', '0.022177461', '-0.028327543', '0', '-0.028794563', 'Remarks from AM');
INSERT INTO public.collection VALUES (732, 'Jan/21', 'Others', 'SP', 'SAS', '83139', '1010522', 'Client_61', 'ADVANCE', '-0.112361014', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (733, 'Jan/21', 'Others', 'SP', 'SAS', '83139', '1010522', 'Client_61', 'DAYS ABOVE 180', '-0.099580434', '-0.103072996', '-0.138549336', '0', '-0.138890063', 'Remarks from AM');
INSERT INTO public.collection VALUES (734, 'Jan/21', 'Others', 'SP', 'SAS', '83139', '1010522', 'Client_61', 'WITHIN CR PD', '-0.048467804', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (735, 'Jan/21', 'Others', 'SP', 'SAS', '83139', '1111094', 'Client_61', 'ADVANCE', '-0.131729131', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (736, 'Jan/21', 'Others', 'SP', 'SAS', '83139', '1111094', 'Client_61', 'DAYS  91-150', '-0.107473296', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (737, 'Jan/21', 'Others', 'SP', 'SAS', '83139', '1111094', 'Client_61', 'DAYS 61-90', '-0.112241476', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (738, 'Jan/21', 'Others', 'SP', 'SAS', '83139', '1111094', 'Client_61', 'DAYS ABOVE 180', '-0.111471641', '-0.177066803', '-0.203664708', '0', '-0.203930825', 'Remarks from AM');
INSERT INTO public.collection VALUES (739, 'Jan/21', 'Others', 'SP', 'SAS', '83139', '1111094', 'Client_61', 'DAYS UPTO 60', '-0.082082287', '-0.000580302', '-0.048354628', '0', '-0.048798701', 'Remarks from AM');
INSERT INTO public.collection VALUES (740, 'Jan/21', 'Others', 'SP', 'SAS', '83139', '1111094', 'Client_61', 'WITHIN CR PD', '0.065117798', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (741, 'Jan/21', 'Others', 'SP', 'SAS', '83147', '1112135', 'Client_104', 'DAYS ABOVE 180', '-0.082530791', '-0.009238205', '-0.055973678', '0', '-0.056409022', 'Remarks from AM');
INSERT INTO public.collection VALUES (742, 'Jan/21', 'Others', 'SP', 'SAS', '83148', '1112200', 'Client_528', 'DAYS ABOVE 180', '-0.108127078', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (743, 'Jan/21', 'Others', 'SP', 'StraightLine', '61013', '1111048', 'Client_181', 'ADVANCE', '-0.112916985', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (744, 'Jan/21', 'Others', 'SP', 'StraightLine', '61062', '1112902', 'Client_21', 'DAYS  91-150', '-0.108346686', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (745, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109403', 'Client_97', 'ADVANCE', '-0.302851173', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (746, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109403', 'Client_97', 'WITHIN CR PD', '0.003063069', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (747, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109404', 'Client_433', 'ADVANCE', '-0.197841195', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (748, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109404', 'Client_433', 'WITHIN CR PD', '-0.026291684', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (749, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109405', 'Client_432', 'ADVANCE', '-0.12619814', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (750, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109405', 'Client_432', 'WITHIN CR PD', '-0.092921482', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (751, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109406', 'Client_51', 'ADVANCE', '-0.273008579', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (752, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109406', 'Client_51', 'DAYS  91-150', '-0.073934809', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (753, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109406', 'Client_51', 'WITHIN CR PD', '-0.063246756', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (754, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109407', 'Client_192', 'ADVANCE', '-0.363481602', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (755, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109407', 'Client_192', 'WITHIN CR PD', '-0.019048835', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (756, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109408', 'Client_98', 'ADVANCE', '-0.15521092', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (757, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109408', 'Client_98', 'WITHIN CR PD', '-0.088515966', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (758, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109409', 'Client_269', 'ADVANCE', '-0.168587808', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (759, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109409', 'Client_269', 'WITHIN CR PD', '-0.095875889', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (760, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109410', 'Client_270', 'ADVANCE', '-0.124364976', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (761, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109415', 'Client_280', 'ADVANCE', '-0.152708936', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (762, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109415', 'Client_280', 'WITHIN CR PD', '-0.081386997', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (763, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109416', 'Client_411', 'ADVANCE', '-0.289866809', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (764, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109416', 'Client_411', 'WITHIN CR PD', '-0.040008671', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (765, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109417', 'Client_117', 'ADVANCE', '-0.19248468', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (766, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109417', 'Client_117', 'WITHIN CR PD', '-0.098179361', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (767, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109420', 'Client_209', 'ADVANCE', '-0.134918427', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (768, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109420', 'Client_209', 'WITHIN CR PD', '-0.107575829', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (769, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109421', 'Client_239', 'ADVANCE', '-0.180215211', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (770, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109421', 'Client_239', 'WITHIN CR PD', '-0.053495984', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (771, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109422', 'Client_246', 'ADVANCE', '-0.146413731', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (772, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109422', 'Client_246', 'WITHIN CR PD', '-0.107788174', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (773, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109423', 'Client_249', 'ADVANCE', '-0.158747844', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (774, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109423', 'Client_249', 'WITHIN CR PD', '-0.095193691', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (775, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109424', 'Client_272', 'ADVANCE', '-0.230454978', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (776, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109424', 'Client_272', 'WITHIN CR PD', '-0.036841221', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (777, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109590', 'Client_31', 'ADVANCE', '-0.163519472', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (778, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109590', 'Client_31', 'WITHIN CR PD', '-0.073925386', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (779, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109594', 'Client_156', 'ADVANCE', '-0.118560294', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (780, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109594', 'Client_156', 'WITHIN CR PD', '-0.110380619', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (781, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109595', 'Client_415', 'ADVANCE', '-0.121830114', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (782, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109595', 'Client_415', 'WITHIN CR PD', '-0.11111762', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (783, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109598', 'Client_154', 'ADVANCE', '-0.117551547', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (784, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109604', 'Client_409', 'ADVANCE', '-0.123501473', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (785, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109636', 'Client_276', 'ADVANCE', '-0.115119904', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (786, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109642', 'Client_251', 'ADVANCE', '-0.225926991', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (787, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109767', 'Client_139', 'ADVANCE', '-0.11461596', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (788, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109770', 'Client_116', 'ADVANCE', '-0.112489513', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (789, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109820', 'Client_240', 'ADVANCE', '-0.116491099', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (790, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109820', 'Client_240', 'WITHIN CR PD', '-0.111776276', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (791, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109953', 'Client_268', 'ADVANCE', '-0.112652196', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (792, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1109954', 'Client_53', 'ADVANCE', '-0.112524618', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (793, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1110193', 'Client_20', 'ADVANCE', '-0.113390694', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (794, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1110193', 'Client_20', 'DAYS UPTO 60', '-0.112272029', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (795, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1110830', 'Client_93', 'ADVANCE', '-0.124815585', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (796, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1110830', 'Client_93', 'WITHIN CR PD', '-0.110333957', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (797, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1111047', 'Client_423', 'ADVANCE', '-0.119582297', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (798, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1111047', 'Client_423', 'WITHIN CR PD', '-0.109552429', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (799, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1112480', 'Client_118', 'ADVANCE', '-0.230920148', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (800, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1112480', 'Client_118', 'DAYS UPTO 60', '-0.083442163', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (801, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1112480', 'Client_118', 'WITHIN CR PD', '-0.099604978', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (802, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1112481', 'Client_407', 'ADVANCE', '-0.140218932', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (803, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1112481', 'Client_407', 'DAYS UPTO 60', '-0.094739673', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (804, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1112943', 'Client_416', 'ADVANCE', '-0.15705772', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (805, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1112943', 'Client_416', 'DAYS UPTO 60', '-0.106400015', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (806, 'Jan/21', 'Others', 'SP', 'StraightLine', '61073', '1112943', 'Client_416', 'WITHIN CR PD', '-0.11111762', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (807, 'Jan/21', 'Others', 'SP', 'StraightLine', '61074', '1111336', 'Client_38', 'ADVANCE', '-0.112402657', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (808, 'Jan/21', 'Others', 'SP', 'StraightLine', '61109', '1109919', 'Client_126', 'ADVANCE', '-0.118126002', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (809, 'Jan/21', 'Others', 'SP', 'StraightLine', '61109', '1109920', 'Client_279', 'ADVANCE', '-0.13086976', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (810, 'Jan/21', 'Others', 'SP', 'StraightLine', '61109', '1109920', 'Client_279', 'DAYS UPTO 60', '-0.107999684', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (811, 'Jan/21', 'Others', 'SP', 'StraightLine', '61118', '1110203', 'Client_180', 'ADVANCE', '-0.118964316', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (812, 'Jan/21', 'Others', 'SP', 'StraightLine', '61118', '1110203', 'Client_180', 'WITHIN CR PD', '-0.107860956', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (813, 'Jan/21', 'Others', 'SP', 'StraightLine', '61120', '1111182', 'Client_170', 'ADVANCE', '-0.11245566', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (814, 'Jan/21', 'Others', 'SP', 'StraightLine', '61160', '1111790', 'Client_195', 'ADVANCE', '-0.127657758', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (815, 'Jan/21', 'Others', 'SP', 'StraightLine', '61170', '1112061', 'Client_101', 'ADVANCE', '-0.112355986', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (816, 'Jan/21', 'Others', 'SP', 'StraightLine', '61186', '1112719', 'Client_24', 'WITHIN CR PD', '-0.084077763', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (817, 'Jan/21', 'Others', 'SP', 'StraightLine', '61191', '1113050', 'Client_81', 'DAYS 61-90', '-0.101017972', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (818, 'Jan/21', 'Others', 'SP', 'Tea', '71001', '1900041', 'Client_470', 'ADVANCE', '-0.112713083', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (819, 'Jan/21', 'Others', 'SP', 'Tea', '71002', '1900041', 'Client_470', 'ADVANCE', '-0.114095974', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (820, 'Jan/21', 'Others', 'SP', 'Tea', '71002', '1900086', 'Client_220', 'ADVANCE', '-0.115362375', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (821, 'Jan/21', 'Others', 'SP', 'Value', '84075', '1109319', 'Client_436', 'ADVANCE', '-0.112486735', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (822, 'Jan/21', 'Others', 'SP', 'Value', '84132', '1222492', 'Client_201', 'DAYS 151-180', '-0.112221085', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (823, 'Jan/21', 'Others', 'SP', 'Value', '84132', '1222780', 'Client_406', 'DAYS ABOVE 180', '-0.112221085', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (824, 'Jan/21', 'Others', 'SP', 'Value', '84167', '1109757', 'Client_157', 'ADVANCE', '-0.112360008', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (825, 'Jan/21', 'Others', 'SP', 'Value', '84206', '1110424', 'Client_404', 'ADVANCE', '-0.112535749', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (826, 'Jan/21', 'Others', 'SP', 'Value', '84206', '1110425', 'Client_535', 'ADVANCE', '-0.11251837', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (827, 'Jan/21', 'Others', 'SP', 'Value', '84216', '1010265', 'Client_476', 'ADVANCE', '-0.112403905', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (828, 'Jan/21', 'Others', 'SP', 'Value', '84227', '1110878', 'Client_114', 'ADVANCE', '-0.11849597', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (829, 'Jan/21', 'Others', 'SP', 'Value', '84228', '1110895', 'Client_152', 'ADVANCE', '-0.112435142', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (830, 'Jan/21', 'Others', 'SP', 'Value', '84321', '1112665', 'Client_469', 'ADVANCE', '-0.120193861', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (831, 'Jan/21', 'Others', 'SP', 'Value', '84321', '1112666', 'Client_298', 'ADVANCE', '-0.113095757', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (832, 'Jan/21', 'SAIL', 'EAM-S', 'Coal', '20912', '1111015', 'Client_361', 'WITHIN CR PD', '-0.104730281', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (833, 'Jan/21', 'SAIL', 'EAM-S', 'EPS', '50222', '1106057', 'Client_306', 'DAYS UPTO 60', '0.136726351', '1.367361353', '1.155449213', '0', '1.153625811', 'Remarks from AM');
INSERT INTO public.collection VALUES (834, 'Jan/21', 'SAIL', 'EAM-S', 'EPS', '50229', '1111254', 'Client_391', 'DAYS  91-150', '-0.094766966', '-0.073120874', '-0.112191136', '0', '-0.112562065', 'Remarks from AM');
INSERT INTO public.collection VALUES (835, 'Jan/21', 'SAIL', 'EAM-S', 'EPS', '50229', '1111254', 'Client_391', 'DAYS UPTO 60', '-0.094766966', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (836, 'Jan/21', 'SAIL', 'EAM-S', 'EPS', '50229', '1111255', 'Client_392', 'DAYS  91-150', '-0.094766966', '-0.073120874', '-0.112191136', '0', '-0.112562065', 'Remarks from AM');
INSERT INTO public.collection VALUES (837, 'Jan/21', 'SAIL', 'EAM-S', 'EPS', '50229', '1111255', 'Client_392', 'DAYS UPTO 60', '-0.094766966', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (838, 'Jan/21', 'SAIL', 'EAM-S', 'EPS', '50229', '1111256', 'Client_393', 'DAYS  91-150', '-0.094766966', '-0.073120874', '-0.112191136', '0', '-0.112562065', 'Remarks from AM');
INSERT INTO public.collection VALUES (839, 'Jan/21', 'SAIL', 'EAM-S', 'EPS', '50229', '1111256', 'Client_393', 'DAYS UPTO 60', '-0.094766966', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (840, 'Jan/21', 'SAIL', 'EAM-S', 'EPS', '50229', '1111257', 'Client_394', 'DAYS  91-150', '-0.094766966', '-0.073120874', '-0.112191136', '0', '-0.112562065', 'Remarks from AM');
INSERT INTO public.collection VALUES (841, 'Jan/21', 'SAIL', 'EAM-S', 'EPS', '50229', '1111257', 'Client_394', 'DAYS UPTO 60', '-0.094766966', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (842, 'Jan/21', 'SAIL', 'EAM-S', 'EPS', '50229', '1111258', 'Client_395', 'DAYS  91-150', '-0.094766966', '-0.073120874', '-0.112191136', '0', '-0.112562065', 'Remarks from AM');
INSERT INTO public.collection VALUES (843, 'Jan/21', 'SAIL', 'EAM-S', 'EPS', '50229', '1111258', 'Client_395', 'DAYS UPTO 60', '-0.094766966', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (844, 'Jan/21', 'SAIL', 'EAM-S', 'EPS', '50229', '1111259', 'Client_397', 'DAYS  91-150', '-0.094766966', '-0.073120874', '-0.112191136', '0', '-0.112562065', 'Remarks from AM');
INSERT INTO public.collection VALUES (845, 'Jan/21', 'SAIL', 'EAM-S', 'EPS', '50229', '1111259', 'Client_397', 'DAYS UPTO 60', '-0.094766966', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (846, 'Jan/21', 'SAIL', 'EAM-S', 'EPS', '50229', '1111260', 'Client_396', 'DAYS  91-150', '-0.094766966', '-0.073120874', '-0.112191136', '0', '-0.112562065', 'Remarks from AM');
INSERT INTO public.collection VALUES (847, 'Jan/21', 'SAIL', 'EAM-S', 'EPS', '50229', '1111260', 'Client_396', 'DAYS UPTO 60', '-0.094766966', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (848, 'Jan/21', 'SAIL', 'EAM-S', 'EPS', '50229', '1111261', 'Client_398', 'DAYS  91-150', '-0.094766966', '-0.073120874', '-0.112191136', '0', '-0.112562065', 'Remarks from AM');
INSERT INTO public.collection VALUES (849, 'Jan/21', 'SAIL', 'EAM-S', 'EPS', '50229', '1111261', 'Client_398', 'DAYS UPTO 60', '-0.094766966', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (850, 'Jan/21', 'SAIL', 'EAM-S', 'EPS', '50230', '1106352', 'Client_388', 'DAYS UPTO 60', '0.065593977', '0.924735527', '0.765933574', '0', '0.764556482', 'Remarks from AM');
INSERT INTO public.collection VALUES (851, 'Jan/21', 'SAIL', 'EAM-S', 'EPS', '50248', '1109313', 'Client_369', 'DAYS ABOVE 180', '0.416211298', '1.855540867', '1.585052605', '0', '1.58273696', 'Remarks from AM');
INSERT INTO public.collection VALUES (852, 'Jan/21', 'SAIL', 'EAM-S', 'EPS', '53266', '1111891', 'Client_448', 'DAYS UPTO 60', '-0.008135757', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (853, 'Jan/21', 'SAIL', 'EAM-S', 'Metal', '11600', '1106005', 'Client_301', 'WITHIN CR PD', '1.039601808', '6.985562654', '6.099528721', '0', '6.09204035', 'Remarks from AM');
INSERT INTO public.collection VALUES (854, 'Jan/21', 'SAIL', 'EAM-S', 'Metal', '11600', '1112737', 'Client_374', 'DAYS  91-150', '-0.047642341', '0.220115169', '0.145859837', '0', '0.145193231', 'Remarks from AM');
INSERT INTO public.collection VALUES (855, 'Jan/21', 'SAIL', 'EAM-S', 'Metal', '11600', '1112737', 'Client_374', 'DAYS 151-180', '-0.038770898', '0.275318303', '0.194439208', '0', '0.193716939', 'Remarks from AM');
INSERT INTO public.collection VALUES (856, 'Jan/21', 'SAIL', 'EAM-S', 'Metal', '11600', '1112737', 'Client_374', 'DAYS UPTO 60', '0.223673048', '1.908392835', '1.631562923', '0', '1.629193986', 'Remarks from AM');
INSERT INTO public.collection VALUES (857, 'Jan/21', 'SAIL', 'EAM-S', 'Metal', '11600', '1112737', 'Client_374', 'WITHIN CR PD', '0.732010376', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (858, 'Jan/21', 'SAIL', 'EAM-S', 'Metal', '11600', '1112738', 'Client_373', 'ADVANCE', '-0.137643828', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (859, 'Jan/21', 'SAIL', 'EAM-S', 'Metal', '11600', '1112738', 'Client_373', 'DAYS  91-150', '-0.0870124', '-0.024867585', '-0.069727706', '0', '-0.070147289', 'Remarks from AM');
INSERT INTO public.collection VALUES (860, 'Jan/21', 'SAIL', 'EAM-S', 'Metal', '11600', '1112738', 'Client_373', 'DAYS 151-180', '-0.050718917', '0.200970348', '0.129012182', '0', '0.12836488', 'Remarks from AM');
INSERT INTO public.collection VALUES (861, 'Jan/21', 'SAIL', 'EAM-S', 'Metal', '11600', '1112738', 'Client_373', 'WITHIN CR PD', '0.467598442', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (862, 'Jan/21', 'SAIL', 'EAM-S', 'Metal', '11700', '1100174', 'Client_388', 'DAYS UPTO 60', '0.037855886', '0.752133455', '0.614041834', '0', '0.612838781', 'Remarks from AM');
INSERT INTO public.collection VALUES (863, 'Jan/21', 'SAIL', 'EAM-S', 'Metal', '11900', '1100109', 'Client_363', 'WITHIN CR PD', '-0.051817637', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (864, 'Jan/21', 'SAIL', 'EAM-S', 'Metal', '11901', '1100118', 'Client_383', 'ADVANCE', '-0.112875972', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (865, 'Jan/21', 'SAIL', 'EAM-S', 'Metal', '11901', '1100118', 'Client_383', 'WITHIN CR PD', '2.676298512', '7.809514049', '6.824615094', '0', '6.816295913', 'Remarks from AM');
INSERT INTO public.collection VALUES (866, 'Jan/21', 'SAIL', 'EAM-S', 'Metal', '11902', '1100116', 'Client_314', 'DAYS  91-150', '0.172022294', '1.586992661', '1.348727202', '0', '1.346682341', 'Remarks from AM');
INSERT INTO public.collection VALUES (867, 'Jan/21', 'SAIL', 'EAM-S', 'Metal', '11902', '1100116', 'Client_314', 'DAYS 61-90', '0.179111016', '1.631101386', '1.38754337', '0', '1.385454033', 'Remarks from AM');
INSERT INTO public.collection VALUES (868, 'Jan/21', 'SAIL', 'EAM-S', 'Metal', '11902', '1100116', 'Client_314', 'DAYS UPTO 60', '0.208860172', '1.81621875', '1.550448706', '0', '1.54817271', 'Remarks from AM');
INSERT INTO public.collection VALUES (869, 'Jan/21', 'SAIL', 'EAM-S', 'Metal', '11902', '1100116', 'Client_314', 'WITHIN CR PD', '0.82885131', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (870, 'Jan/21', 'SAIL', 'EAM-S', 'Metal', '11902', '1100117', 'Client_315', 'DAYS  91-150', '-0.00265751', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (871, 'Jan/21', 'SAIL', 'EAM-S', 'Metal', '11902', '1100117', 'Client_315', 'DAYS 61-90', '-0.068037153', '0.093207123', '0.034179347', '0', '0.033640706', 'Remarks from AM');
INSERT INTO public.collection VALUES (872, 'Jan/21', 'SAIL', 'EAM-S', 'Metal', '11902', '1100117', 'Client_315', 'DAYS UPTO 60', '-0.105853737', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (873, 'Jan/21', 'SAIL', 'EAM-S', 'Metal', '11902', '1100117', 'Client_315', 'WITHIN CR PD', '0.040016869', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (874, 'Jan/21', 'SAIL', 'EAM-S', 'Metal', '11903', '1100109', 'Client_363', 'DAYS UPTO 60', '-0.025782836', '0.356137362', '0.265560877', '0', '0.264757117', 'Remarks from AM');
INSERT INTO public.collection VALUES (875, 'Jan/21', 'SAIL', 'EAM-S', 'Metal', '11903', '1100109', 'Client_363', 'WITHIN CR PD', '0.827893491', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (876, 'Jan/21', 'SAIL', 'EAM-S', 'Metal', '11904', '1100113', 'Client_372', 'DAYS  91-150', '1.736559009', '11.3224242', '9.916015021', '0', '9.904153687', 'Remarks from AM');
INSERT INTO public.collection VALUES (877, 'Jan/21', 'SAIL', 'EAM-S', 'Metal', '11904', '1100113', 'Client_372', 'DAYS 61-90', '0.125281524', '1.296145174', '1.092778185', '0', '1.091026592', 'Remarks from AM');
INSERT INTO public.collection VALUES (878, 'Jan/21', 'SAIL', 'EAM-S', 'Metal', '11904', '1100113', 'Client_372', 'DAYS UPTO 60', '-0.006213037', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (879, 'Jan/21', 'SAIL', 'EAM-S', 'Metal', '11904', '1100113', 'Client_372', 'WITHIN CR PD', '2.441192004', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (880, 'Jan/21', 'SAIL', 'EAM-S', 'MSS/CMS', '50016', '1111214', 'Client_392', 'DAYS 151-180', '-0.085099178', '-0.012962436', '-0.059251042', '0', '-0.05968263', 'Remarks from AM');
INSERT INTO public.collection VALUES (881, 'Jan/21', 'SAIL', 'EAM-S', 'MSS/CMS', '50016', '1111223', 'Client_398', 'DAYS 151-180', '-0.100464077', '-0.108572323', '-0.143388804', '0', '-0.143723986', 'Remarks from AM');
INSERT INTO public.collection VALUES (882, 'Jan/21', 'SAIL', 'EAM-S', 'MSS/CMS', '50016', '1111230', 'Client_395', 'DAYS 151-180', '-0.10552088', '-0.140037805', '-0.171078778', '0', '-0.171382233', 'Remarks from AM');
INSERT INTO public.collection VALUES (883, 'Jan/21', 'SAIL', 'EAM-S', 'MSS/CMS', '50050', '1111890', 'Client_389', 'WITHIN CR PD', '-0.021080868', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (884, 'Jan/21', 'SAIL', 'EAM-S', 'MSS/CMS', '50052', '1112595', 'Client_380', 'DAYS UPTO 60', '0.303494111', '1.615783558', '1.374063511', '0', '1.371989619', 'Remarks from AM');
INSERT INTO public.collection VALUES (885, 'Jan/21', 'SAIL', 'EAM-S', 'MSS/CMS', '50052', '1112595', 'Client_380', 'WITHIN CR PD', '0.265921716', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (886, 'Jan/21', 'SAIL', 'EAM-S', 'MSS/CMS', '50053', '1112740', 'Client_365', 'DAYS UPTO 60', '-0.112012379', '-0.180431584', '-0.206625752', '0', '-0.206888477', 'Remarks from AM');
INSERT INTO public.collection VALUES (887, 'Jan/21', 'SAIL', 'EAM-S', 'MSS/CMS', '50053', '1112740', 'Client_365', 'WITHIN CR PD', '-0.05486445', '0.147669634', '0.082106962', '0', '0.081513405', 'Remarks from AM');
INSERT INTO public.collection VALUES (888, 'Jan/21', 'SAIL', 'EAM-S', 'MSS/CMS', '50054', '1112821', 'Client_376', 'DAYS UPTO 60', '0.01705985', '0.580831173', '0.463293924', '0', '0.4622636', 'Remarks from AM');
INSERT INTO public.collection VALUES (889, 'Jan/21', 'SAIL', 'EAM-S', 'MSS/CMS', '50054', '1112821', 'Client_376', 'WITHIN CR PD', '0.015796912', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (890, 'Jan/21', 'SAIL', 'EAM-S', 'MSS/CMS', '50055', '1112822', 'Client_376', 'DAYS UPTO 60', '-0.070145996', '0.080084712', '0.022631481', '0', '0.022106071', 'Remarks from AM');
INSERT INTO public.collection VALUES (891, 'Jan/21', 'SAIL', 'EAM-S', 'MSS/CMS', '50055', '1112822', 'Client_376', 'WITHIN CR PD', '-0.067620121', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (892, 'Jan/21', 'SAIL', 'EAM-S', 'MSS/CMS', '53107', '1111613', 'Client_370', 'DAYS  91-150', '-0.094646987', '-0.072374297', '-0.11153414', '0', '-0.111905821', 'Remarks from AM');
INSERT INTO public.collection VALUES (893, 'Jan/21', 'SAIL', 'EAM-S', 'MSS/CMS', '53107', '1111613', 'Client_370', 'DAYS 61-90', '-0.041603605', '0.257691599', '0.178927512', '0', '0.178223017', 'Remarks from AM');
INSERT INTO public.collection VALUES (894, 'Jan/21', 'SAIL', 'EAM-S', 'MSS/CMS', '53107', '1111613', 'Client_370', 'DAYS ABOVE 180', '-0.105957903', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (895, 'Jan/21', 'SAIL', 'EAM-S', 'MSS/CMS', '53107', '1111613', 'Client_370', 'DAYS UPTO 60', '0.029120904', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (896, 'Jan/21', 'SAIL', 'EAM-S', 'MSS/CMS', '53107', '1111613', 'Client_370', 'WITHIN CR PD', '-0.041603605', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (897, 'Jan/21', 'SAIL', 'EAM-S', 'MSS/CMS', '53952', '1108071', 'Client_309', 'DAYS UPTO 60', '0.266868919', '1.899496374', '1.623733939', '0', '1.621373972', 'Remarks from AM');
INSERT INTO public.collection VALUES (898, 'Jan/21', 'SAIL', 'EAM-S', 'MSS/CMS', '53952', '1108071', 'Client_309', 'WITHIN CR PD', '0.255818215', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (899, 'Jan/21', 'SAIL', 'EAM-S', 'MSS/CMS', '53970', '1100036', 'Client_400', 'ADVANCE', '-0.113037499', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (900, 'Jan/21', 'SAIL', 'EAM-S', 'MSS/CMS', '53970', '1108781', 'Client_305', 'ADVANCE', '-0.112660005', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (901, 'Jan/21', 'SAIL', 'EAM-S', 'MSS/CMS', '53970', '1108781', 'Client_305', 'DAYS 151-180', '-0.105551815', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (902, 'Jan/21', 'SAIL', 'EAM-S', 'MSS/CMS', '53970', '1108781', 'Client_305', 'DAYS UPTO 60', '0.283287109', '2.279345211', '1.958005132', '0', '1.955262154', 'Remarks from AM');
INSERT INTO public.collection VALUES (903, 'Jan/21', 'SAIL', 'EAM-S', 'MSS/CMS', '53970', '1108781', 'Client_305', 'WITHIN CR PD', '0.284865781', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (904, 'Jan/21', 'SAIL', 'EAM-S', 'MSS/CMS', '53973', '1108780', 'Client_367', 'DAYS UPTO 60', '0.282024171', '2.271486499', '1.951089378', '0', '1.948354325', 'Remarks from AM');
INSERT INTO public.collection VALUES (905, 'Jan/21', 'SAIL', 'EAM-S', 'MSS/CMS', '53973', '1108780', 'Client_367', 'WITHIN CR PD', '0.271289201', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (906, 'Jan/21', 'SAIL', 'EAM-S', 'MSS/CMS', '53999', '1109207', 'Client_310', 'DAYS UPTO 60', '0.274219216', '2.22291966', '1.908350021', '0', '1.905663938', 'Remarks from AM');
INSERT INTO public.collection VALUES (907, 'Jan/21', 'SAIL', 'EAM-S', 'MSS/CMS', '53999', '1109207', 'Client_310', 'WITHIN CR PD', '0.236091128', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (908, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '50015', '1108546', 'Client_317', 'ADVANCE', '-0.172317653', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (909, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '50015', '1108546', 'Client_317', 'DAYS UPTO 60', '-0.052338575', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (910, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '50015', '1108546', 'Client_317', 'WITHIN CR PD', '-0.025101505', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (911, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52100', '1100037', 'Client_387', 'DAYS ABOVE 180', '-0.108791888', '-0.160391869', '-0.18899058', '0', '-0.189273511', 'Remarks from AM');
INSERT INTO public.collection VALUES (912, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52101', '1100044', 'Client_384', 'DAYS  91-150', '0.312967107', '2.464030266', '2.12053003', '0', '2.117600831', 'Remarks from AM');
INSERT INTO public.collection VALUES (913, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52101', '1100044', 'Client_384', 'DAYS 61-90', '0.128941348', '1.318917389', '1.112817988', '0', '1.111043433', 'Remarks from AM');
INSERT INTO public.collection VALUES (914, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52101', '1100044', 'Client_384', 'DAYS UPTO 60', '0.806535897', '1.482585053', '1.256847348', '0', '1.254907763', 'Remarks from AM');
INSERT INTO public.collection VALUES (915, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52101', '1100044', 'Client_384', 'WITHIN CR PD', '1.58780131', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (916, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52102', '1100045', 'Client_385', 'ADVANCE', '-0.113199432', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (917, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52102', '1100045', 'Client_385', 'DAYS  91-150', '-0.078696955', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (918, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52102', '1100045', 'Client_385', 'DAYS UPTO 60', '-0.101981118', '-0.118012101', '-0.151695914', '0', '-0.152021577', 'Remarks from AM');
INSERT INTO public.collection VALUES (919, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52102', '1100045', 'Client_385', 'WITHIN CR PD', '0.616015016', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (920, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52102', '1107787', 'Client_385', 'WITHIN CR PD', '-0.095657337', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (921, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52103', '1100038', 'Client_390', 'ADVANCE', '-0.113717345', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (922, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52103', '1100038', 'Client_390', 'DAYS UPTO 60', '-0.108791888', '-0.160391869', '-0.18899058', '0', '-0.189273511', 'Remarks from AM');
INSERT INTO public.collection VALUES (923, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52103', '1100038', 'Client_390', 'WITHIN CR PD', '1.078496685', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (924, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52104', '1100036', 'Client_400', 'ADVANCE', '-0.114259552', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (925, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52104', '1100036', 'Client_400', 'DAYS  91-150', '0.180114022', '1.637343068', '1.393036119', '0', '1.390940488', 'Remarks from AM');
INSERT INTO public.collection VALUES (926, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52104', '1100036', 'Client_400', 'DAYS 151-180', '-0.08678862', '-0.023475101', '-0.068502304', '0', '-0.068923292', 'Remarks from AM');
INSERT INTO public.collection VALUES (927, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52104', '1100036', 'Client_400', 'DAYS 61-90', '0.173261504', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (928, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52104', '1100036', 'Client_400', 'DAYS ABOVE 180', '-0.076390649', '0.041226952', '-0.01156378', '0', '-0.012050008', 'Remarks from AM');
INSERT INTO public.collection VALUES (929, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52104', '1100036', 'Client_400', 'DAYS UPTO 60', '-0.03090697', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (930, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52104', '1100036', 'Client_400', 'WITHIN CR PD', '1.367088625', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (931, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52105', '1100039', 'Client_382', 'DAYS UPTO 60', '-0.101719437', '-0.116383083', '-0.15026236', '0', '-0.150589666', 'Remarks from AM');
INSERT INTO public.collection VALUES (932, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52105', '1100039', 'Client_382', 'WITHIN CR PD', '-0.031459212', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (933, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52107', '1112275', 'Client_316', 'DAYS 151-180', '-0.11018112', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (934, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52107', '1112305', 'Client_379', 'DAYS  91-150', '-0.105752946', '-0.14148185', '-0.172349554', '0', '-0.172651553', 'Remarks from AM');
INSERT INTO public.collection VALUES (935, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52108', '1111212', 'Client_392', 'DAYS UPTO 60', '-0.019064686', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (936, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52108', '1111212', 'Client_392', 'WITHIN CR PD', '-0.033366757', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (937, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52108', '1111215', 'Client_394', 'DAYS UPTO 60', '-0.103530661', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (938, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52108', '1111218', 'Client_397', 'DAYS  91-150', '-0.108791888', '-0.160391869', '-0.18899058', '0', '-0.189273511', 'Remarks from AM');
INSERT INTO public.collection VALUES (939, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52108', '1111218', 'Client_397', 'DAYS UPTO 60', '-0.09166186', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (940, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52108', '1111218', 'Client_397', 'WITHIN CR PD', '-0.057642913', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (941, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52108', '1111226', 'Client_393', 'DAYS UPTO 60', '-0.108129777', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (942, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52108', '1111226', 'Client_393', 'WITHIN CR PD', '-0.075450334', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (943, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52108', '1111228', 'Client_395', 'DAYS UPTO 60', '-0.099054607', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (944, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52108', '1111231', 'Client_396', 'DAYS UPTO 60', '-0.0984358', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (945, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52108', '1111233', 'Client_399', 'WITHIN CR PD', '-0.092121111', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (946, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52109', '1106020', 'Client_304', 'DAYS UPTO 60', '-0.1044979', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (947, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52109', '1106020', 'Client_304', 'WITHIN CR PD', '-0.088458592', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (948, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52110', '1107884', 'Client_375', 'ADVANCE', '-0.142817351', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (949, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52110', '1107884', 'Client_375', 'WITHIN CR PD', '0.178040492', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (950, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52200', '1100040', 'Client_302', 'DAYS 61-90', '0.067885935', '0.938997384', '0.778484166', '0', '0.777092694', 'Remarks from AM');
INSERT INTO public.collection VALUES (951, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52200', '1100040', 'Client_302', 'WITHIN CR PD', '1.052521926', '4.510826428', '3.921733373', '0', '3.916740338', 'Remarks from AM');
INSERT INTO public.collection VALUES (952, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '52300', '1100042', 'Client_388', 'WITHIN CR PD', '0.045311735', '0.243838955', '0.166737032', '0', '0.166046504', 'Remarks from AM');
INSERT INTO public.collection VALUES (953, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '53981', '1109010', 'Client_366', 'WITHIN CR PD', '-0.058779557', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (954, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '54003', '1111024', 'Client_375', 'WITHIN CR PD', '-0.087574536', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (955, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '54029', '1110663', 'Client_386', 'DAYS 151-180', '-0.108791888', '-0.160391869', '-0.18899058', '0', '-0.189273511', 'Remarks from AM');
INSERT INTO public.collection VALUES (956, 'Jan/21', 'SAIL', 'EAM-S', 'RA/AS', '54042', '1111085', 'Client_303', 'WITHIN CR PD', '-0.012387563', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (957, 'Jan/21', 'SAIL', 'EAM-S', 'StraightLine', '61192', '1113180', 'Client_360', 'WITHIN CR PD', '0.178147548', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (958, 'Jan/21', 'SAIL', 'EAM-S', 'TP', '83120', '1111103', 'Client_378', 'WITHIN CR PD', '-0.105255663', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (959, 'Jan/21', 'SAIL', 'EAM-S', 'Value', '84063', '1100119', 'Client_311', 'WITHIN CR PD', '-0.110967298', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (960, 'Jan/21', 'SAIL', 'EAM-S', 'Value', '84064', '1100117', 'Client_315', 'DAYS 61-90', '-0.083324095', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (961, 'Jan/21', 'SAIL', 'EAM-S', 'Value', '84064', '1100117', 'Client_315', 'DAYS UPTO 60', '-0.106698451', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (962, 'Jan/21', 'SAIL', 'EAM-S', 'Value', '84064', '1100117', 'Client_315', 'WITHIN CR PD', '-0.040893202', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (963, 'Jan/21', 'SAIL', 'EAM-S', 'Value', '84065', '1100110', 'Client_364', 'DAYS UPTO 60', '0.166845926', '1.554782372', '1.320381791', '0', '1.318369407', 'Remarks from AM');
INSERT INTO public.collection VALUES (964, 'Jan/21', 'SAIL', 'EAM-S', 'Value', '84065', '1100110', 'Client_364', 'WITHIN CR PD', '-0.104204141', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (965, 'Jan/21', 'SAIL', 'EAM-S', 'Value', '84066', '1106005', 'Client_301', 'WITHIN CR PD', '-0.109173987', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (966, 'Jan/21', 'SAIL', 'EAM-S', 'Value', '84071', '1100114', 'Client_371', 'DAYS  91-150', '-0.045255261', '0.234968933', '0.158931314', '0', '0.158249731', 'Remarks from AM');
INSERT INTO public.collection VALUES (967, 'Jan/21', 'SAIL', 'EAM-S', 'Value', '84071', '1100114', 'Client_371', 'DAYS 151-180', '-0.108407148', '-0.157997799', '-0.186883772', '0', '-0.187169117', 'Remarks from AM');
INSERT INTO public.collection VALUES (968, 'Jan/21', 'SAIL', 'EAM-S', 'Value', '84071', '1100114', 'Client_371', 'DAYS 61-90', '-0.106310475', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (969, 'Jan/21', 'SAIL', 'EAM-S', 'Value', '84071', '1100114', 'Client_371', 'DAYS ABOVE 180', '-0.109147936', '-0.1626074', '-0.190940272', '0', '-0.191220969', 'Remarks from AM');
INSERT INTO public.collection VALUES (970, 'Jan/21', 'SAIL', 'EAM-S', 'Value', '84071', '1100114', 'Client_371', 'DAYS UPTO 60', '-0.107497377', '-0.152336689', '-0.181901933', '0', '-0.182192986', 'Remarks from AM');
INSERT INTO public.collection VALUES (971, 'Jan/21', 'SAIL', 'EAM-S', 'Value', '84071', '1100114', 'Client_371', 'WITHIN CR PD', '-0.078209478', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (972, 'Jan/21', 'SAIL', 'EAM-S', 'Value', '84241', '1111086', 'Client_303', 'DAYS UPTO 60', '-0.086330542', '-0.02062468', '-0.065993902', '0', '-0.066417764', 'Remarks from AM');
INSERT INTO public.collection VALUES (973, 'Jan/21', 'SAIL', 'EAM-S', 'Value', '84241', '1111086', 'Client_303', 'WITHIN CR PD', '-0.100203912', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (974, 'Jan/21', 'SAIL', 'RM-East', 'Metal', '11900', '1100133', 'Client_326', 'DAYS 61-90', '-0.036079017', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (975, 'Jan/21', 'SAIL', 'RM-East', 'Metal', '11900', '1100134', 'Client_340', 'ADVANCE', '-0.114281726', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (976, 'Jan/21', 'SAIL', 'RM-East', 'Metal', '11900', '1100134', 'Client_340', 'DAYS 61-90', '-0.040390671', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (977, 'Jan/21', 'SAIL', 'RM-East', 'Metal', '11900', '1100134', 'Client_340', 'WITHIN CR PD', '-0.03487969', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (978, 'Jan/21', 'SAIL', 'RM-East', 'Metal', '11900', '1100135', 'Client_341', 'ADVANCE', '-0.112826871', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (979, 'Jan/21', 'SAIL', 'RM-East', 'Metal', '11900', '1100135', 'Client_341', 'DAYS 61-90', '0.013794184', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (980, 'Jan/21', 'SAIL', 'RM-East', 'Metal', '11900', '1100135', 'Client_341', 'WITHIN CR PD', '-0.090377487', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (981, 'Jan/21', 'SAIL', 'RM-East', 'Metal', '11900', '1100136', 'Client_354', 'WITHIN CR PD', '-0.048550004', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (982, 'Jan/21', 'SAIL', 'RM-East', 'Metal', '11900', '1100183', 'Client_353', 'WITHIN CR PD', '-0.048282124', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (983, 'Jan/21', 'SAIL', 'RM-East', 'Metal', '11900', '1100196', 'Client_325', 'WITHIN CR PD', '-0.095783106', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (984, 'Jan/21', 'SAIL', 'RM-East', 'Metal', '11900', '1100197', 'Client_345', 'ADVANCE', '-0.114924975', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (985, 'Jan/21', 'SAIL', 'RM-East', 'Metal', '11900', '1100197', 'Client_345', 'WITHIN CR PD', '-0.10347927', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (986, 'Jan/21', 'SAIL', 'RM-East', 'Metal', '11900', '1106010', 'Client_337', 'WITHIN CR PD', '-0.088246132', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (987, 'Jan/21', 'SAIL', 'RM-North', 'Metal', '11600', '1112549', 'Client_446', 'DAYS 61-90', '-0.097398067', '-0.089493075', '-0.126598855', '0', '-0.126953275', 'Remarks from AM');
INSERT INTO public.collection VALUES (988, 'Jan/21', 'SAIL', 'RM-North', 'Metal', '11600', '1112549', 'Client_446', 'WITHIN CR PD', '-0.093211844', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (989, 'Jan/21', 'SAIL', 'RM-North', 'Metal', '11600', '1112683', 'Client_381', 'WITHIN CR PD', '-0.054803626', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (990, 'Jan/21', 'SAIL', 'RM-North', 'Metal', '14203', '1100123', 'Client_358', 'WITHIN CR PD', '0.002892219', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (991, 'Jan/21', 'SAIL', 'RM-North', 'Metal', '14203', '1100124', 'Client_359', 'DAYS  91-150', '-0.110060888', '-0.167558388', '-0.195297197', '0', '-0.195572902', 'Remarks from AM');
INSERT INTO public.collection VALUES (992, 'Jan/21', 'SAIL', 'RM-North', 'Metal', '14203', '1100124', 'Client_359', 'WITHIN CR PD', '-0.071212564', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (993, 'Jan/21', 'SAIL', 'RM-North', 'Metal', '14203', '1100125', 'Client_328', 'DAYS UPTO 60', '-0.108912424', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (994, 'Jan/21', 'SAIL', 'RM-North', 'Metal', '14203', '1100125', 'Client_328', 'WITHIN CR PD', '-0.084002015', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (995, 'Jan/21', 'SAIL', 'RM-North', 'Metal', '14203', '1100126', 'Client_346', 'DAYS UPTO 60', '-0.100278779', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (996, 'Jan/21', 'SAIL', 'RM-North', 'Metal', '14203', '1100126', 'Client_346', 'WITHIN CR PD', '0.001292507', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (997, 'Jan/21', 'SAIL', 'RM-North', 'Metal', '14203', '1100127', 'Client_330', 'DAYS 61-90', '-0.088914463', '-0.036703298', '-0.080143264', '0', '-0.080550914', 'Remarks from AM');
INSERT INTO public.collection VALUES (998, 'Jan/21', 'SAIL', 'RM-North', 'Metal', '14203', '1100127', 'Client_330', 'DAYS UPTO 60', '-0.101988595', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (999, 'Jan/21', 'SAIL', 'RM-North', 'Metal', '14203', '1100127', 'Client_330', 'WITHIN CR PD', '-0.073412659', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1000, 'Jan/21', 'SAIL', 'RM-North', 'Metal', '14203', '1100128', 'Client_348', 'DAYS 61-90', '-0.09138295', '-0.052063616', '-0.093660515', '0', '-0.094052676', 'Remarks from AM');
INSERT INTO public.collection VALUES (1001, 'Jan/21', 'SAIL', 'RM-North', 'Metal', '14203', '1100128', 'Client_348', 'DAYS UPTO 60', '-0.103254968', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1002, 'Jan/21', 'SAIL', 'RM-North', 'Metal', '14203', '1100128', 'Client_348', 'WITHIN CR PD', '-0.061536319', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1003, 'Jan/21', 'SAIL', 'RM-North', 'Metal', '14203', '1100129', 'Client_350', 'WITHIN CR PD', '-0.067637294', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1004, 'Jan/21', 'SAIL', 'RM-North', 'Metal', '14203', '1100130', 'Client_332', 'WITHIN CR PD', '-0.038728253', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1005, 'Jan/21', 'SAIL', 'RM-North', 'Metal', '14203', '1100131', 'Client_335', 'DAYS 61-90', '-0.076842091', '0.038417822', '-0.014035845', '0', '-0.014519241', 'Remarks from AM');
INSERT INTO public.collection VALUES (1006, 'Jan/21', 'SAIL', 'RM-North', 'Metal', '14203', '1100131', 'Client_335', 'DAYS UPTO 60', '-0.109771119', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1007, 'Jan/21', 'SAIL', 'RM-North', 'Metal', '14203', '1100131', 'Client_335', 'WITHIN CR PD', '-0.066305413', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1008, 'Jan/21', 'SAIL', 'RM-North', 'Metal', '14203', '1100132', 'Client_352', 'DAYS 61-90', '-0.109943587', '-0.167558388', '-0.195297197', '0', '-0.195572902', 'Remarks from AM');
INSERT INTO public.collection VALUES (1009, 'Jan/21', 'SAIL', 'RM-North', 'Metal', '14203', '1100132', 'Client_352', 'DAYS UPTO 60', '-0.109371324', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1010, 'Jan/21', 'SAIL', 'RM-North', 'Metal', '14203', '1100132', 'Client_352', 'WITHIN CR PD', '-0.072273712', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1011, 'Jan/21', 'SAIL', 'RM-North', 'Metal', '14203', '1100191', 'Client_327', 'WITHIN CR PD', '-0.106770469', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1012, 'Jan/21', 'SAIL', 'RM-North', 'Metal', '14203', '1100193', 'Client_318', 'DAYS UPTO 60', '-0.109020328', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1013, 'Jan/21', 'SAIL', 'RM-North', 'Metal', '14203', '1100193', 'Client_318', 'WITHIN CR PD', '-0.111133435', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1014, 'Jan/21', 'SAIL', 'RM-North', 'Metal', '14203', '1100194', 'Client_349', 'WITHIN CR PD', '-0.083590766', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1015, 'Jan/21', 'SAIL', 'RM-North', 'Metal', '14203', '1100205', 'Client_344', 'WITHIN CR PD', '-0.104091254', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1016, 'Jan/21', 'SAIL', 'RM-South', 'Metal', '11906', '1100120', 'Client_308', 'WITHIN CR PD', '-0.069578736', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1017, 'Jan/21', 'SAIL', 'RM-South', 'Metal', '11907', '1100122', 'Client_307', 'DAYS  91-150', '-0.104629287', '-0.134489808', '-0.166196479', '0', '-0.166505528', 'Remarks from AM');
INSERT INTO public.collection VALUES (1018, 'Jan/21', 'SAIL', 'RM-South', 'Metal', '14204', '1100147', 'Client_321', 'WITHIN CR PD', '0.100340902', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1019, 'Jan/21', 'SAIL', 'RM-South', 'Metal', '14204', '1100148', 'Client_322', 'WITHIN CR PD', '-0.078545927', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1020, 'Jan/21', 'SAIL', 'RM-South', 'Metal', '14204', '1100151', 'Client_347', 'WITHIN CR PD', '-0.094509951', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1021, 'Jan/21', 'SAIL', 'RM-South', 'Metal', '14204', '1100152', 'Client_355', 'ADVANCE', '-0.112338175', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1022, 'Jan/21', 'SAIL', 'RM-South', 'Metal', '14204', '1100152', 'Client_355', 'WITHIN CR PD', '-0.077897164', '-0.182396262', '-0.019813348', '0', '-0.020290124', 'Remarks from AM');
INSERT INTO public.collection VALUES (1023, 'Jan/21', 'SAIL', 'RM-South', 'Metal', '14204', '1100153', 'Client_356', 'WITHIN CR PD', '-0.097636084', '-0.182396262', '-0.127902216', '0', '-0.128255143', 'Remarks from AM');
INSERT INTO public.collection VALUES (1024, 'Jan/21', 'SAIL', 'RM-South', 'Metal', '14204', '1100199', 'Client_319', 'WITHIN CR PD', '-0.010146193', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1025, 'Jan/21', 'SAIL', 'RM-South', 'Metal', '14204', '1100200', 'Client_320', 'WITHIN CR PD', '-0.111724408', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1026, 'Jan/21', 'SAIL', 'RM-South', 'Metal', '14204', '1100201', 'Client_329', 'WITHIN CR PD', '0.06012343', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1027, 'Jan/21', 'SAIL', 'RM-South', 'Metal', '14204', '1106153', 'Client_331', 'WITHIN CR PD', '-0.108092281', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1028, 'Jan/21', 'SAIL', 'RM-South', 'Metal', '14204', '1106217', 'Client_357', 'ADVANCE', '-0.113019305', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1029, 'Jan/21', 'SAIL', 'RM-South', 'Metal', '14204', '1106217', 'Client_357', 'WITHIN CR PD', '-0.030865355', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1030, 'Jan/21', 'SAIL', 'RM-South', 'Metal', '14204', '1107667', 'Client_336', 'WITHIN CR PD', '-0.09241039', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1031, 'Jan/21', 'SAIL', 'RM-South', 'RA/AS', '52106', '1100034', 'Client_402', 'WITHIN CR PD', '0.378449462', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1032, 'Jan/21', 'SAIL', 'RM-South', 'RA/AS', '52107', '1100035', 'Client_401', 'DAYS 61-90', '-0.099030864', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1033, 'Jan/21', 'SAIL', 'RM-South', 'RA/AS', '52107', '1100035', 'Client_401', 'WITHIN CR PD', '0.854268425', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1034, 'Jan/21', 'SAIL', 'RM-South', 'Value', '84073', '1100120', 'Client_308', 'WITHIN CR PD', '-0.112136811', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1035, 'Jan/21', 'SAIL', 'RM-West', 'Metal', '14202', '1100138', 'Client_323', 'WITHIN CR PD', '-0.047545885', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1036, 'Jan/21', 'SAIL', 'RM-West', 'Metal', '14202', '1100139', 'Client_342', 'WITHIN CR PD', '-0.097402413', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1037, 'Jan/21', 'SAIL', 'RM-West', 'Metal', '14202', '1100140', 'Client_324', 'WITHIN CR PD', '-0.086432189', '-0.021257186', '-0.066550515', '0', '-0.066973739', 'Remarks from AM');
INSERT INTO public.collection VALUES (1038, 'Jan/21', 'SAIL', 'RM-West', 'Metal', '14202', '1100141', 'Client_343', 'ADVANCE', '-0.112541764', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1039, 'Jan/21', 'SAIL', 'RM-West', 'Metal', '14202', '1100141', 'Client_343', 'WITHIN CR PD', '0.076992907', '0.995666116', '0.828353279', '0', '0.826904666', 'Remarks from AM');
INSERT INTO public.collection VALUES (1040, 'Jan/21', 'SAIL', 'RM-West', 'Metal', '14202', '1100142', 'Client_338', 'WITHIN CR PD', '0.014571462', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1041, 'Jan/21', 'SAIL', 'RM-West', 'Metal', '14202', '1100144', 'Client_333', 'DAYS UPTO 60', '-0.09955466', '-0.102912611', '-0.138408196', '0', '-0.138749085', 'Remarks from AM');
INSERT INTO public.collection VALUES (1042, 'Jan/21', 'SAIL', 'RM-West', 'Metal', '14202', '1100145', 'Client_334', 'WITHIN CR PD', '-0.092695275', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1043, 'Jan/21', 'SAIL', 'RM-West', 'Metal', '14202', '1100146', 'Client_351', 'WITHIN CR PD', '-0.041332874', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1044, 'Jan/21', 'SAIL', 'RM-West', 'Metal', '14202', '1100181', 'Client_339', 'DAYS UPTO 60', '-0.082474543', '0.003369526', '-0.044878735', '0', '-0.045326791', 'Remarks from AM');
INSERT INTO public.collection VALUES (1045, 'Jan/21', 'SAIL', 'SP', 'Coal', '20912', '1106463', 'Client_362', 'WITHIN CR PD', '-0.010085369', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1046, 'Jan/21', 'SAIL', 'SP', 'Content', '40002', '1109352', 'Client_446', 'ADVANCE', '-0.11437236', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1047, 'Jan/21', 'SAIL', 'SP', 'Content', '40004', '1107782', 'Client_447', 'WITHIN CR PD', '-0.107832912', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1048, 'Jan/21', 'SAIL', 'SP', 'OVC', '83105', '1009348', 'Client_377', 'WITHIN CR PD', '2.294199601', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1049, 'Jan/21', 'SAIL Group', 'EAM-S', 'EPS', '53248', '1009139', 'Client_313', 'DAYS 151-180', '-0.013818976', '0.430583259', '0.331074092', '0', '0.330195266', 'Remarks from AM');
INSERT INTO public.collection VALUES (1050, 'Jan/21', 'SAIL Group', 'EAM-S', 'EPS', '53248', '1009139', 'Client_313', 'DAYS 61-90', '-0.013818976', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1051, 'Jan/21', 'SAIL Group', 'EAM-S', 'EPS', '53248', '1009139', 'Client_313', 'WITHIN CR PD', '-0.013818976', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1052, 'Jan/21', 'SAIL Group', 'EAM-S', 'RA/AS', '53240', '1109145', 'Client_312', 'DAYS  91-150', '-0.011892934', '0.442567128', '0.34162003', '0', '0.340729121', 'Remarks from AM');
INSERT INTO public.collection VALUES (1053, 'Jan/21', 'SAIL Group', 'EAM-S', 'RA/AS', '53240', '1109145', 'Client_312', 'DAYS 61-90', '-0.098661598', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1054, 'Jan/21', 'SAIL Group', 'EAM-S', 'RA/AS', '53240', '1109145', 'Client_312', 'DAYS UPTO 60', '-0.101719437', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1055, 'Jan/21', 'SAIL Group', 'EAM-S', 'RA/AS', '53240', '1109145', 'Client_312', 'WITHIN CR PD', '-0.060042495', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1056, 'Jan/21', 'SAIL Group', 'RM-South', 'EPS', '53260', '1010385', 'Client_414', 'DAYS UPTO 60', '-0.070651171', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1057, 'Jan/21', 'SAIL Group', 'RM-South', 'EPS', '53260', '1010385', 'Client_414', 'WITHIN CR PD', '-0.070651171', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1058, 'Jan/21', 'SAIL Group', 'RM-South', 'RA/AS', '54000', '1109115', 'Client_368', 'DAYS 61-90', '-0.089413628', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1059, 'Jan/21', 'SAIL Group', 'RM-South', 'RA/AS', '54000', '1109115', 'Client_368', 'WITHIN CR PD', '-0.005357294', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1060, 'Jan/21', 'Tata Group', 'AM-TSL-KOL', 'EPS', '53264', '1111675', 'Client_486', 'DAYS UPTO 60', '-0.107023776', '-0.182396262', '-0.179308525', '0', '-0.17960255', 'Remarks from AM');
INSERT INTO public.collection VALUES (1061, 'Jan/21', 'Tata Group', 'AM-TSL-KOL', 'EPS', '53264', '1111675', 'Client_486', 'WITHIN CR PD', '-0.105760838', '-0.182396262', '-0.172392772', '0', '-0.172694721', 'Remarks from AM');
INSERT INTO public.collection VALUES (1062, 'Jan/21', 'Tata Group', 'AM-TSL-KOL', 'Metal', '14288', '1109220', 'Client_485', 'WITHIN CR PD', '0.060417392', '-0.182396262', '0.266896637', '0', '0.266091346', 'Remarks from AM');
INSERT INTO public.collection VALUES (1063, 'Jan/21', 'Tata Group', 'AM-TSL-KOL', 'Metal', '14335', '1111835', 'Client_491', 'DAYS UPTO 60', '0.105037235', '0.323968232', '0.981921948', '0', '0.980297375', 'Remarks from AM');
INSERT INTO public.collection VALUES (1064, 'Jan/21', 'Tata Group', 'AM-TSL-KOL', 'Metal', '14335', '1111835', 'Client_491', 'WITHIN CR PD', '0.005672148', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1065, 'Jan/21', 'Tata Group', 'AM-TSL-KOL', 'Metal', '14336', '1111836', 'Client_493', 'DAYS UPTO 60', '0.359503594', '-0.182396262', '2.161078829', '0', '2.158103168', 'Remarks from AM');
INSERT INTO public.collection VALUES (1066, 'Jan/21', 'Tata Group', 'AM-TSL-KOL', 'Metal', '14336', '1111836', 'Client_493', 'WITHIN CR PD', '0.265066669', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1067, 'Jan/21', 'Tata Group', 'EAM-T', 'Metal', '10102', '1112346', 'Client_502', 'DAYS UPTO 60', '0.175392553', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1068, 'Jan/21', 'Tata Group', 'EAM-T', 'Metal', '10102', '1112346', 'Client_502', 'WITHIN CR PD', '0.027590072', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1069, 'Jan/21', 'Tata Group', 'EAM-T', 'Metal', '10700', '1100177', 'Client_150', 'ADVANCE', '-0.122721787', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1070, 'Jan/21', 'Tata Group', 'EAM-T', 'Metal', '10700', '1100177', 'Client_150', 'DAYS  91-150', '-0.066486386', '-0.182396262', '0.042671236', '0', '0.042122865', 'Remarks from AM');
INSERT INTO public.collection VALUES (1071, 'Jan/21', 'Tata Group', 'EAM-T', 'Metal', '10700', '1100177', 'Client_150', 'DAYS UPTO 60', '-0.066735538', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1072, 'Jan/21', 'Tata Group', 'EAM-T', 'Metal', '10700', '1100177', 'Client_150', 'WITHIN CR PD', '-0.051898944', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1073, 'Jan/21', 'Tata Group', 'EAM-T', 'Metal', '13000', '1100161', 'Client_522', 'DAYS UPTO 60', '0.431099207', '-0.182396262', '2.767413296', '0', '2.763742892', 'Remarks from AM');
INSERT INTO public.collection VALUES (1074, 'Jan/21', 'Tata Group', 'EAM-T', 'Metal', '13000', '1100161', 'Client_522', 'WITHIN CR PD', '0.163017191', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1075, 'Jan/21', 'Tata Group', 'EAM-T', 'Metal', '14293', '1109426', 'Client_172', 'DAYS UPTO 60', '1.282908275', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1076, 'Jan/21', 'Tata Group', 'EAM-T', 'Metal', '14293', '1109426', 'Client_172', 'WITHIN CR PD', '0.83848003', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1077, 'Jan/21', 'Tata Group', 'EAM-T', 'Metal', '14338', '1111926', 'Client_489', 'DAYS UPTO 60', '0.856809117', '4.193526197', '3.642505647', '0', '3.637832554', 'Remarks from AM');
INSERT INTO public.collection VALUES (1078, 'Jan/21', 'Tata Group', 'EAM-T', 'Metal', '14338', '1111926', 'Client_489', 'WITHIN CR PD', '0.693227101', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1079, 'Jan/21', 'Tata Group', 'EAM-T', 'RA/AS', '53600', '1106050', 'Client_514', 'DAYS UPTO 60', '-0.098616652', '-0.0970758', '-0.133271736', '0', '-0.133618511', 'Remarks from AM');
INSERT INTO public.collection VALUES (1080, 'Jan/21', 'Tata Group', 'EAM-T', 'RA/AS', '53600', '1106050', 'Client_514', 'WITHIN CR PD', '-0.058651472', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1081, 'Jan/21', 'Tata Group', 'EAM-T', 'RA/AS', '54007', '1110979', 'Client_462', 'ADVANCE', '-0.123030975', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1082, 'Jan/21', 'Tata Group', 'EAM-T', 'RA/AS', '54007', '1110979', 'Client_462', 'DAYS ABOVE 180', '-0.102016119', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1083, 'Jan/21', 'Tata Group', 'EAM-T', 'Value', '84037', '1100177', 'Client_150', 'DAYS  91-150', '-0.099263627', '-0.182396262', '-0.136814466', '0', '-0.137157181', 'Remarks from AM');
INSERT INTO public.collection VALUES (1084, 'Jan/21', 'Tata Group', 'EAM-T', 'Value', '84037', '1100177', 'Client_150', 'DAYS 61-90', '-0.102125286', '-0.182396262', '-0.152484755', '0', '-0.152809515', 'Remarks from AM');
INSERT INTO public.collection VALUES (1085, 'Jan/21', 'Tata Group', 'EAM-T', 'Value', '84037', '1100177', 'Client_150', 'DAYS UPTO 60', '-0.107678635', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1086, 'Jan/21', 'Tata Group', 'EAM-T', 'Value', '84037', '1100177', 'Client_150', 'WITHIN CR PD', '-0.11096744', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1087, 'Jan/21', 'Tata Group', 'EAM-T', 'Value', '84280', '1111926', 'Client_489', 'WITHIN CR PD', '-0.107618399', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1088, 'Jan/21', 'Tata Group', 'EAM-T', 'Value', '84307', '1112358', 'Client_502', 'DAYS UPTO 60', '-0.072681917', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1089, 'Jan/21', 'Tata Group', 'EAM-T', 'Value', '84307', '1112358', 'Client_502', 'WITHIN CR PD', '-0.10003031', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1090, 'Jan/21', 'Tata Group', 'RM-East', 'Value', '84186', '1109973', 'Client_484', 'DAYS 61-90', '-0.097352828', '-0.08921192', '-0.126351435', '0', '-0.126706139', 'Remarks from AM');
INSERT INTO public.collection VALUES (1091, 'Jan/21', 'Tata Group', 'RM-East', 'Value', '84280', '1112910', 'Client_490', 'DAYS UPTO 60', '-0.062496427', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1092, 'Jan/21', 'Tata Group', 'RM-East', 'Value', '84280', '1112910', 'Client_490', 'WITHIN CR PD', '-0.066776594', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1093, 'Jan/21', 'Tata Group', 'RM-North', 'Metal', '14282', '1111021', 'Client_462', 'DAYS UPTO 60', '-0.022028964', '0.379496078', '0.286116806', '0', '0.285289492', 'Remarks from AM');
INSERT INTO public.collection VALUES (1094, 'Jan/21', 'Tata Group', 'RM-North', 'Metal', '14282', '1111021', 'Client_462', 'WITHIN CR PD', '-0.076032523', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1095, 'Jan/21', 'Tata Group', 'RM-North', 'Metal', '14282', '1111022', 'Client_462', 'DAYS UPTO 60', '-0.074672253', '0.051919782', '-0.002153971', '0', '-0.002650981', 'Remarks from AM');
INSERT INTO public.collection VALUES (1096, 'Jan/21', 'Tata Group', 'RM-North', 'Metal', '14282', '1111022', 'Client_462', 'WITHIN CR PD', '-0.086352408', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1097, 'Jan/21', 'Tata Group', 'RM-North', 'Metal', '14282', '1111023', 'Client_462', 'DAYS UPTO 60', '-0.108284909', '-0.157237156', '-0.186214397', '0', '-0.18650051', 'Remarks from AM');
INSERT INTO public.collection VALUES (1098, 'Jan/21', 'Tata Group', 'RM-North', 'Metal', '14336', '1112322', 'Client_489', 'DAYS UPTO 60', '0.492970414', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1099, 'Jan/21', 'Tata Group', 'RM-North', 'Metal', '14336', '1112322', 'Client_489', 'WITHIN CR PD', '0.503086981', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1100, 'Jan/21', 'Tata Group', 'RM-North', 'Value', '84116', '1111022', 'Client_462', 'DAYS UPTO 60', '-0.111662768', '-0.178256106', '-0.204711307', '0', '-0.204976226', 'Remarks from AM');
INSERT INTO public.collection VALUES (1101, 'Jan/21', 'Tata Group', 'RM-North', 'Value', '84116', '1111022', 'Client_462', 'WITHIN CR PD', '-0.112096495', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1102, 'Jan/21', 'Tata Group', 'RM-North', 'Value', '84120', '1109697', 'Client_516', 'DAYS UPTO 60', '-0.027995199', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1103, 'Jan/21', 'Tata Group', 'RM-North', 'Value', '84279', '1111925', 'Client_489', 'DAYS UPTO 60', '-0.10359113', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1104, 'Jan/21', 'Tata Group', 'RM-North', 'Value', '84279', '1111925', 'Client_489', 'WITHIN CR PD', '-0.10017735', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1105, 'Jan/21', 'Tata Group', 'RM-South', 'Metal', '14282', '1110582', 'Client_462', 'DAYS UPTO 60', '-0.070980355', '-0.182396262', '0.018062594', '0', '0.017542419', 'Remarks from AM');
INSERT INTO public.collection VALUES (1106, 'Jan/21', 'Tata Group', 'RM-South', 'Metal', '14282', '1110586', 'Client_462', 'WITHIN CR PD', '-0.091913801', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1107, 'Jan/21', 'Tata Group', 'RM-South', 'Value', '84186', '1111279', 'Client_484', 'WITHIN CR PD', '0.033331301', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1108, 'Jan/21', 'Tata Group', 'RM-West', 'EPS', '53269', '1112791', 'Client_483', 'DAYS  91-150', '-0.036551854', '0.289126446', '0.206590527', '0', '0.205854335', 'Remarks from AM');
INSERT INTO public.collection VALUES (1109, 'Jan/21', 'Tata Group', 'RM-West', 'EPS', '53269', '1112791', 'Client_483', 'DAYS UPTO 60', '-0.074439984', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1110, 'Jan/21', 'Tata Group', 'RM-West', 'Metal', '14337', '1111837', 'Client_492', 'DAYS 61-90', '0.013355883', '0.599680586', '0.479881617', '0', '0.478832286', 'Remarks from AM');
INSERT INTO public.collection VALUES (1111, 'Jan/21', 'Tata Group', 'RM-West', 'Metal', '14337', '1111837', 'Client_492', 'DAYS UPTO 60', '0.342589368', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1112, 'Jan/21', 'Tata Group', 'RM-West', 'Metal', '14337', '1111837', 'Client_492', 'WITHIN CR PD', '0.115273822', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1113, 'Jan/21', 'Tata Group', 'RM-West', 'Metal', '14337', '1112965', 'Client_489', 'DAYS UPTO 60', '0.778986522', '5.363867071', '4.672418607', '0', '4.666565431', 'Remarks from AM');
INSERT INTO public.collection VALUES (1114, 'Jan/21', 'Tata Group', 'RM-West', 'Metal', '14337', '1112965', 'Client_489', 'WITHIN CR PD', '0.409317229', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1115, 'Jan/21', 'Tata Group', 'RM-West', 'MSS/CMS', '53302', '1112861', 'Client_454', 'DAYS  91-150', '-0.105839277', '-0.142019053', '-0.172822298', '0', '-0.173123755', 'Remarks from AM');
INSERT INTO public.collection VALUES (1116, 'Jan/21', 'Tata Group', 'RM-West', 'MSS/CMS', '53302', '1112861', 'Client_454', 'DAYS UPTO 60', '0.056690598', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1117, 'Jan/21', 'Tata Group', 'RM-West', 'MSS/CMS', '53302', '1112862', 'Client_456', 'DAYS UPTO 60', '-0.109549788', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1118, 'Jan/21', 'Tata Group', 'RM-West', 'MSS/CMS', '53302', '1112863', 'Client_457', 'DAYS UPTO 60', '0.039471336', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1119, 'Jan/21', 'Tata Group', 'RM-West', 'SAS', '83156', '1112526', 'Client_459', 'ADVANCE', '-0.124362411', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1120, 'Jan/21', 'Tata Group', 'RM-West', 'SAS', '83156', '1112526', 'Client_459', 'DAYS UPTO 60', '-0.040825057', '0.262536029', '0.183190664', '0', '0.182481285', 'Remarks from AM');
INSERT INTO public.collection VALUES (1121, 'Jan/21', 'Tata Group', 'RM-West', 'SAS', '83156', '1112526', 'Client_459', 'WITHIN CR PD', '-0.036852373', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1122, 'Jan/21', 'Tata Group', 'RM-West', 'StraightLine', '61118', '1113096', 'Client_479', 'DAYS UPTO 60', '-0.107276363', '-0.150961415', '-0.180691676', '0', '-0.180984116', 'Remarks from AM');
INSERT INTO public.collection VALUES (1123, 'Jan/21', 'Tata Group', 'RM-West', 'Value', '84106', '1100162', 'Client_521', 'DAYS UPTO 60', '-0.025756265', '0.356302701', '0.265706377', '0', '0.26490245', 'Remarks from AM');
INSERT INTO public.collection VALUES (1124, 'Jan/21', 'Tata Group', 'RM-West', 'Value', '84276', '1111921', 'Client_492', 'DAYS  91-150', '-0.094328245', '-0.070390904', '-0.109788732', '0', '-0.110162414', 'Remarks from AM');
INSERT INTO public.collection VALUES (1125, 'Jan/21', 'Tata Group', 'RM-West', 'Value', '84276', '1111921', 'Client_492', 'DAYS UPTO 60', '-0.086612203', '-0.02916349', '-0.07350815', '0', '-0.073923402', 'Remarks from AM');
INSERT INTO public.collection VALUES (1126, 'Jan/21', 'Tata Group', 'RM-West', 'Value', '84276', '1111921', 'Client_492', 'WITHIN CR PD', '-0.110866527', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1127, 'Jan/21', 'Tata Group', 'SP', 'Content', '40004', '1112613', 'Client_520', 'DAYS 61-90', '-0.111065176', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1128, 'Jan/21', 'Tata Group', 'SP', 'Content', '40004', '1112769', 'Client_520', 'DAYS UPTO 60', '-0.088206004', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1129, 'Jan/21', 'Tata Group', 'SP', 'Content', '40009', '1111555', 'Client_466', 'DAYS ABOVE 180', '-0.111900004', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1130, 'Jan/21', 'Tata Group', 'SP', 'FJ', '30102', '1007101', 'Client_480', 'DAYS UPTO 60', '-0.081317576', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1131, 'Jan/21', 'Tata Group', 'SP', 'Metal', '14291', '1109356', 'Client_479', 'WITHIN CR PD', '0.032231233', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1132, 'Jan/21', 'Tata Group', 'SP', 'MSS/CMS', '50012', '1009314', 'Client_460', 'ADVANCE', '-0.112485913', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1133, 'Jan/21', 'Tata Group', 'SP', 'MSS/CMS', '50012', '1109334', 'Client_460', 'ADVANCE', '-0.113060618', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1134, 'Jan/21', 'Tata Group', 'SP', 'OVC', '54055', '1112300', 'Client_489', 'DAYS UPTO 60', '-0.028011238', '0.042460131', '-0.010478569', '0', '-0.010966041', 'Remarks from AM');
INSERT INTO public.collection VALUES (1135, 'Jan/21', 'Tata Group', 'SP', 'OVC', '54055', '1112300', 'Client_489', 'WITHIN CR PD', '-0.064147042', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1136, 'Jan/21', 'Tata Group', 'SP', 'StraightLine', '60970', '1110998', 'Client_458', 'ADVANCE', '-0.122069283', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1137, 'Jan/21', 'Tata Group', 'SP', 'StraightLine', '61078', '1109450', 'Client_487', 'WITHIN CR PD', '-0.110357931', '-0.170136672', '-0.197566115', '0', '-0.19783922', 'Remarks from AM');
INSERT INTO public.collection VALUES (1138, 'Jan/21', 'Tata Group', 'SP', 'Tea', '83101', '1111031', 'Client_481', 'WITHIN CR PD', '0.031421168', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1139, 'Jan/21', 'Tata Group', 'SP', 'Value', '84011', '1009200', 'Client_482', 'ADVANCE', '-0.112493792', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1140, 'Jan/21', 'Tata Group', 'SP', 'Value', '84135', '1009326', 'Client_478', 'WITHIN CR PD', '-0.105779506', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1141, 'Jan/21', 'TSL', 'AM-TSL-KOL', 'Metal', '12500', '1100154', 'Client_495', 'DAYS  91-150', '1.001592209', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1142, 'Jan/21', 'TSL', 'AM-TSL-KOL', 'Metal', '12500', '1100154', 'Client_495', 'DAYS 61-90', '0.97780705', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1143, 'Jan/21', 'TSL', 'AM-TSL-KOL', 'Metal', '12500', '1100154', 'Client_495', 'DAYS UPTO 60', '1.493567964', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1144, 'Jan/21', 'TSL', 'AM-TSL-KOL', 'Metal', '12500', '1100154', 'Client_495', 'WITHIN CR PD', '0.524615227', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1145, 'Jan/21', 'TSL', 'AM-TSL-KOL', 'Metal', '12503', '1100049', 'Client_109', 'WITHIN CR PD', '-0.084982099', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1146, 'Jan/21', 'TSL', 'AM-TSL-KOL', 'Metal', '13500', '1106040', 'Client_515', 'ADVANCE', '-0.170709591', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1147, 'Jan/21', 'TSL', 'AM-TSL-KOL', 'Metal', '13500', '1106040', 'Client_515', 'DAYS UPTO 60', '0.036073605', '-0.182396262', '0.602781158', '0', '0.601591008', 'Remarks from AM');
INSERT INTO public.collection VALUES (1148, 'Jan/21', 'TSL', 'AM-TSL-KOL', 'Metal', '14334', '1111676', 'Client_495', 'DAYS  91-150', '0.296358514', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1149, 'Jan/21', 'TSL', 'AM-TSL-KOL', 'Metal', '14334', '1111676', 'Client_495', 'DAYS 61-90', '0.0920152', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1150, 'Jan/21', 'TSL', 'AM-TSL-KOL', 'Metal', '14334', '1111676', 'Client_495', 'DAYS UPTO 60', '0.296358514', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1151, 'Jan/21', 'TSL', 'AM-TSL-KOL', 'Metal', '14334', '1111676', 'Client_495', 'WITHIN CR PD', '0.0920152', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1152, 'Jan/21', 'TSL', 'AM-TSL-KOL', 'StraightLine', '60940', '1106040', 'Client_515', 'ADVANCE', '-0.112597019', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1153, 'Jan/21', 'TSL', 'EAM-T', 'Coal', '20928', '1109733', 'Client_495', 'DAYS  91-150', '1.706131627', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1154, 'Jan/21', 'TSL', 'EAM-T', 'Coal', '20928', '1109733', 'Client_495', 'DAYS 61-90', '0.796901757', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1155, 'Jan/21', 'TSL', 'EAM-T', 'Coal', '20928', '1109733', 'Client_495', 'DAYS UPTO 60', '1.706131627', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1156, 'Jan/21', 'TSL', 'EAM-T', 'Coal', '20928', '1109733', 'Client_495', 'WITHIN CR PD', '0.796901757', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1157, 'Jan/21', 'TSL', 'EAM-T', 'Coal', '20931', '1111013', 'Client_500', 'DAYS 61-90', '0.190776925', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1158, 'Jan/21', 'TSL', 'EAM-T', 'Coal', '20931', '1111013', 'Client_500', 'DAYS ABOVE 180', '0.387052846', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1159, 'Jan/21', 'TSL', 'EAM-T', 'Coal', '20931', '1111013', 'Client_500', 'DAYS UPTO 60', '1.047230523', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1160, 'Jan/21', 'TSL', 'EAM-T', 'Coal', '20931', '1111013', 'Client_500', 'WITHIN CR PD', '0.190776925', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1161, 'Jan/21', 'TSL', 'EAM-T', 'Metal', '13400', '1100299', 'Client_505', 'ADVANCE', '-0.177708145', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1162, 'Jan/21', 'TSL', 'EAM-T', 'Metal', '13400', '1100299', 'Client_505', 'DAYS 61-90', '-0.015274368', '0.421526986', '0.323104471', '0', '0.322234777', 'Remarks from AM');
INSERT INTO public.collection VALUES (1163, 'Jan/21', 'TSL', 'EAM-T', 'Metal', '13400', '1100299', 'Client_505', 'DAYS UPTO 60', '4.899643548', '10.58689431', '11.96963152', '0', '11.95541713', 'Remarks from AM');
INSERT INTO public.collection VALUES (1164, 'Jan/21', 'TSL', 'EAM-T', 'Metal', '13400', '1100299', 'Client_505', 'WITHIN CR PD', '1.892893359', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1165, 'Jan/21', 'TSL', 'EAM-T', 'Metal', '13400', '1109733', 'Client_495', 'DAYS UPTO 60', '0.190947927', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1166, 'Jan/21', 'TSL', 'EAM-T', 'Metal', '18000', '1106053', 'Client_504', 'DAYS UPTO 60', '1.933630899', '-0.182396262', '5.393405743', '0', '5.386726454', 'Remarks from AM');
INSERT INTO public.collection VALUES (1167, 'Jan/21', 'TSL', 'EAM-T', 'Metal', '18000', '1106053', 'Client_504', 'WITHIN CR PD', '0.910651393', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1168, 'Jan/21', 'TSL', 'EAM-T', 'MSS/CMS', '53989', '1100299', 'Client_505', 'ADVANCE', '-0.137821358', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1169, 'Jan/21', 'TSL', 'EAM-T', 'RA/AS', '51500', '1100017', 'Client_510', 'DAYS  91-150', '0.031620382', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1170, 'Jan/21', 'TSL', 'EAM-T', 'RA/AS', '51500', '1100017', 'Client_510', 'DAYS 151-180', '0.046137722', '-0.182396262', '0.2063626', '0', '0.20562667', 'Remarks from AM');
INSERT INTO public.collection VALUES (1171, 'Jan/21', 'TSL', 'EAM-T', 'RA/AS', '51500', '1100017', 'Client_510', 'DAYS UPTO 60', '0.124093483', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1172, 'Jan/21', 'TSL', 'EAM-T', 'RA/AS', '51500', '1100017', 'Client_510', 'WITHIN CR PD', '-0.036551854', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1173, 'Jan/21', 'TSL', 'EAM-T', 'RA/AS', '51500', '1112374', 'Client_495', 'DAYS 61-90', '0.012848918', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1174, 'Jan/21', 'TSL', 'EAM-T', 'RA/AS', '51500', '1112374', 'Client_495', 'DAYS UPTO 60', '0.030919328', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1175, 'Jan/21', 'TSL', 'EAM-T', 'RA/AS', '54049', '1111645', 'Client_499', 'DAYS 61-90', '0.013965652', '-0.182396262', '0.483220672', '0', '0.482167515', 'Remarks from AM');
INSERT INTO public.collection VALUES (1176, 'Jan/21', 'TSL', 'EAM-T', 'RA/AS', '54049', '1111645', 'Client_499', 'DAYS UPTO 60', '0.140259419', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1177, 'Jan/21', 'TSL', 'EAM-T', 'RA/AS', '54049', '1111645', 'Client_499', 'WITHIN CR PD', '0.013965652', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1178, 'Jan/21', 'TSL', 'EAM-T', 'Value', '84099', '1100299', 'Client_505', 'DAYS UPTO 60', '-0.083176008', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1179, 'Jan/21', 'TSL', 'EAM-T', 'Value', '84099', '1100299', 'Client_505', 'WITHIN CR PD', '-0.040605546', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1180, 'Jan/21', 'TSL', 'RM-South', 'Metal', '12500', '1110809', 'Client_496', 'DAYS  91-150', '0.077283586', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1181, 'Jan/21', 'TSL', 'RM-South', 'Metal', '12500', '1110809', 'Client_496', 'DAYS 151-180', '-0.029659556', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1182, 'Jan/21', 'TSL', 'RM-South', 'Metal', '12500', '1110809', 'Client_496', 'DAYS 61-90', '0.193503349', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1183, 'Jan/21', 'TSL', 'RM-South', 'Metal', '12500', '1110809', 'Client_496', 'DAYS UPTO 60', '0.321807579', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1184, 'Jan/21', 'TSL', 'RM-South', 'Metal', '12500', '1110809', 'Client_496', 'WITHIN CR PD', '0.025851161', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1185, 'Jan/21', 'TSL', 'RM-West', 'Metal', '12500', '1110808', 'Client_523', 'DAYS  91-150', '0.012935153', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1186, 'Jan/21', 'TSL', 'RM-West', 'Metal', '12500', '1110808', 'Client_523', 'DAYS 151-180', '-0.036589943', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1187, 'Jan/21', 'TSL', 'RM-West', 'Metal', '12500', '1110808', 'Client_523', 'DAYS 61-90', '-0.007811092', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1188, 'Jan/21', 'TSL', 'RM-West', 'Metal', '12500', '1110808', 'Client_523', 'DAYS UPTO 60', '0.229108252', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1189, 'Jan/21', 'TSL', 'RM-West', 'Metal', '12500', '1110808', 'Client_523', 'WITHIN CR PD', '0.019563716', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1190, 'Jan/21', 'TSL', 'RM-West', 'Metal', '14321', '1110957', 'Client_509', 'DAYS UPTO 60', '0.143392643', '0.703170883', '0.570954227', '0', '0.569800544', 'Remarks from AM');
INSERT INTO public.collection VALUES (1191, 'Jan/21', 'TSL', 'RM-West', 'Metal', '14321', '1110957', 'Client_509', 'WITHIN CR PD', '-0.008486245', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1192, 'Jan/21', 'TSL', 'RM-West', 'Value', '84341', '1110957', 'Client_509', 'DAYS UPTO 60', '-0.100849969', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1193, 'Jan/21', 'TSL', 'SP', 'Coal', '20914', '1100105', 'Client_506', 'DAYS  91-150', '-0.069753687', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1194, 'Jan/21', 'TSL', 'SP', 'Coal', '20928', '1109563', 'Client_503', 'DAYS UPTO 60', '-0.112327709', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1195, 'Jan/21', 'TSL', 'SP', 'Coal', '20928', '1109656', 'Client_507', 'DAYS ABOVE 180', '-0.111797746', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1196, 'Jan/21', 'TSL', 'SP', 'Coal', '20928', '1109656', 'Client_507', 'DAYS UPTO 60', '-0.112326954', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1197, 'Jan/21', 'TSL', 'SP', 'Conference', '40006', '1011411', 'Client_495', 'DAYS ABOVE 180', '-0.11104377', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1198, 'Jan/21', 'TSL', 'SP', 'Metal', '12500', '1100154', 'Client_495', 'ADVANCE', '-0.341411469', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1199, 'Jan/21', 'TSL', 'SP', 'Metal', '13400', '1011291', 'Client_464', 'DAYS ABOVE 180', '-0.112263734', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1200, 'Jan/21', 'TSL', 'SP', 'Metal', '13400', '1100105', 'Client_506', 'ADVANCE', '-0.334602319', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1201, 'Jan/21', 'TSL', 'SP', 'Metal', '13400', '1100105', 'Client_506', 'WITHIN CR PD', '-0.105906397', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1202, 'Jan/21', 'TSL', 'SP', 'Metal', '13400', '1109563', 'Client_503', 'ADVANCE', '-0.115314212', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1203, 'Jan/21', 'TSL', 'SP', 'Metal', '13400', '1109563', 'Client_503', 'DAYS ABOVE 180', '-0.111852342', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1204, 'Jan/21', 'TSL', 'SP', 'Metal', '13400', '1109771', 'Client_511', 'DAYS ABOVE 180', '-0.112328114', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1205, 'Jan/21', 'TSL', 'SP', 'Metal', '13400', '1110323', 'Client_465', 'ADVANCE', '-0.113169735', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1206, 'Jan/21', 'TSL', 'SP', 'Metal', '14334', '1100105', 'Client_506', 'ADVANCE', '-0.123030975', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1207, 'Jan/21', 'TSL', 'SP', 'OVC', '50021', '1110865', 'Client_495', 'DAYS UPTO 60', '-0.003920702', '0.042460131', '-0.010478569', '0', '-0.010966041', 'Remarks from AM');
INSERT INTO public.collection VALUES (1208, 'Jan/21', 'TSL', 'SP', 'OVC', '50021', '1110865', 'Client_495', 'WITHIN CR PD', '-0.064147042', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1209, 'Jan/21', 'TSL', 'SP', 'RA/AS', '50001', '1110091', 'Client_463', 'DAYS ABOVE 180', '-0.105042389', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1210, 'Jan/21', 'TSL', 'SP', 'RA/AS', '51500', '1109563', 'Client_503', 'DAYS ABOVE 180', '-0.108735219', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1211, 'Jan/21', 'TSL', 'SP', 'RA/AS', '51500', '1110798', 'Client_501', 'DAYS ABOVE 180', '-0.108652681', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1212, 'Jan/21', 'TSL', 'SP', 'SAS', '83003', '1109656', 'Client_507', 'ADVANCE', '-0.112359773', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1213, 'Jan/21', 'TSL', 'SP', 'SAS', '83003', '1109656', 'Client_507', 'DAYS  91-150', '-0.111661283', '-0.181064277', '-0.207182529', '0', '-0.207444615', 'Remarks from AM');
INSERT INTO public.collection VALUES (1214, 'Jan/21', 'TSL', 'SP', 'SAS', '83003', '1109656', 'Client_507', 'DAYS 151-180', '-0.112218887', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1215, 'Jan/21', 'TSL', 'SP', 'SAS', '83003', '1109656', 'Client_507', 'DAYS ABOVE 180', '-0.111608498', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1216, 'Jan/21', 'TSL', 'SP', 'SAS', '83102', '1109563', 'Client_503', 'ADVANCE', '-0.683097496', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1217, 'Jan/21', 'TSL', 'SP', 'SAS', '83102', '1109563', 'Client_503', 'DAYS  91-150', '-0.112248313', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1218, 'Jan/21', 'TSL', 'SP', 'SAS', '83102', '1109563', 'Client_503', 'DAYS 151-180', '-0.112290459', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1219, 'Jan/21', 'TSL', 'SP', 'SAS', '83102', '1109563', 'Client_503', 'DAYS ABOVE 180', '-0.052316593', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1220, 'Jan/21', 'TSL', 'SP', 'SAS', '83102', '1109563', 'Client_503', 'DAYS UPTO 60', '-0.041526009', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1221, 'Jan/21', 'TSL', 'SP', 'SAS', '83102', '1109563', 'Client_503', 'WITHIN CR PD', '-0.082953956', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1222, 'Jan/21', 'TSL', 'SP', 'SAS', '83102', '1109656', 'Client_507', 'ADVANCE', '-0.11255154', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1223, 'Jan/21', 'TSL', 'SP', 'SAS', '83102', '1109656', 'Client_507', 'DAYS ABOVE 180', '-0.111063791', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1224, 'Jan/21', 'TSL', 'SP', 'SAS', '83102', '1110091', 'Client_463', 'DAYS ABOVE 180', '-0.111942687', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1225, 'Jan/21', 'TSL', 'SP', 'SAS', '83102', '1110798', 'Client_501', 'ADVANCE', '-0.112552549', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1226, 'Jan/21', 'TSL', 'SP', 'SAS', '83102', '1110798', 'Client_501', 'DAYS ABOVE 180', '-0.109427897', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1227, 'Jan/21', 'TSL', 'SP', 'SAS', '83102', '1110798', 'Client_501', 'DAYS UPTO 60', '-0.109189376', '-0.162865259', '-0.191167191', '0', '-0.191447628', 'Remarks from AM');
INSERT INTO public.collection VALUES (1228, 'Jan/21', 'TSL', 'SP', 'SAS', '83102', '1110798', 'Client_501', 'WITHIN CR PD', '-0.100094794', '-0.106273636', '-0.141365934', '0', '-0.141703434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1229, 'Jan/21', 'TSL', 'SP', 'SAS', '83122', '1109656', 'Client_507', 'WITHIN CR PD', '-0.106493342', '-0.146089013', '-0.176403909', '0', '-0.176701262', 'Remarks from AM');
INSERT INTO public.collection VALUES (1230, 'Jan/21', 'TSL', 'SP', 'SAS', '83151', '1011291', 'Client_464', 'DAYS ABOVE 180', '-0.11018213', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1231, 'Jan/21', 'TSL', 'SP', 'SAS', '83151', '1112320', 'Client_464', 'DAYS ABOVE 180', '-0.111998534', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1232, 'Jan/21', 'TSL', 'SP', 'StraightLine', '60201', '1111580', 'Client_467', 'DAYS ABOVE 180', '-0.104102669', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1233, 'Jan/21', 'TSL', 'SP', 'StraightLine', '60201', '1111580', 'Client_467', 'WITHIN CR PD', '-0.093919273', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1234, 'Jan/21', 'TSL', 'SP', 'StraightLine', '60940', '1107660', 'Client_488', 'ADVANCE', '-0.133025215', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1235, 'Jan/21', 'TSL', 'SP', 'StraightLine', '60992', '1109771', 'Client_511', 'ADVANCE', '-0.12791409', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1236, 'Jan/21', 'TSL', 'SP', 'StraightLine', '61065', '1109363', 'Client_508', 'ADVANCE', '-0.154408597', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1237, 'Jan/21', 'TSL', 'SP', 'StraightLine', '61065', '1109363', 'Client_508', 'DAYS  91-150', '-0.066862358', '-0.182396262', '0.04061244', '0', '0.040066428', 'Remarks from AM');
INSERT INTO public.collection VALUES (1238, 'Jan/21', 'TSL', 'SP', 'StraightLine', '61065', '1109363', 'Client_508', 'DAYS 151-180', '-0.089595236', '-0.182396262', '-0.083871125', '0', '-0.084274503', 'Remarks from AM');
INSERT INTO public.collection VALUES (1239, 'Jan/21', 'TSL', 'SP', 'StraightLine', '61065', '1109363', 'Client_508', 'DAYS 61-90', '-0.089595236', '-0.182396262', '-0.083871125', '0', '-0.084274503', 'Remarks from AM');
INSERT INTO public.collection VALUES (1240, 'Jan/21', 'TSL', 'SP', 'StraightLine', '61065', '1109363', 'Client_508', 'DAYS ABOVE 180', '-0.066862358', '-0.182396262', '0.04061244', '0', '0.040066428', 'Remarks from AM');
INSERT INTO public.collection VALUES (1241, 'Jan/21', 'TSL', 'SP', 'StraightLine', '61065', '1109363', 'Client_508', 'DAYS UPTO 60', '-0.066862358', '-0.182396262', '0.04061244', '0', '0.040066428', 'Remarks from AM');
INSERT INTO public.collection VALUES (1242, 'Jan/21', 'TSL', 'SP', 'StraightLine', '61065', '1109363', 'Client_508', 'WITHIN CR PD', '-0.089595236', '-0.182396262', '-0.083871125', '0', '-0.084274503', 'Remarks from AM');
INSERT INTO public.collection VALUES (1243, 'Jan/21', 'TSL', 'SP', 'StraightLine', '61082', '1009405', 'Client_494', 'ADVANCE', '-0.114129316', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1244, 'Jan/21', 'TSL', 'SP', 'StraightLine', '61084', '1109982', 'Client_497', 'DAYS  91-150', '0.133186968', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1245, 'Jan/21', 'TSL', 'SP', 'StraightLine', '61084', '1109982', 'Client_497', 'DAYS 151-180', '0.255944508', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1246, 'Jan/21', 'TSL', 'SP', 'StraightLine', '61084', '1109982', 'Client_497', 'DAYS 61-90', '0.010429427', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1247, 'Jan/21', 'TSL', 'SP', 'StraightLine', '61084', '1109982', 'Client_497', 'DAYS ABOVE 180', '-0.08836972', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1248, 'Jan/21', 'TSL', 'SP', 'StraightLine', '61084', '1109982', 'Client_497', 'WITHIN CR PD', '0.255944508', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1249, 'Jan/21', 'TSL', 'SP', 'StraightLine', '61084', '1111825', 'Client_468', 'DAYS ABOVE 180', '-0.111688903', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1250, 'Jan/21', 'TSL', 'SP', 'StraightLine', '61096', '1109746', 'Client_498', 'ADVANCE', '-0.122431615', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1251, 'Jan/21', 'TSL', 'SP', 'StraightLine', '85005', '1109982', 'Client_497', 'ADVANCE', '-0.115676536', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1252, 'Jan/21', 'TSL', 'SP', 'Value', '84300', '1100105', 'Client_506', 'DAYS UPTO 60', '-0.108880607', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1253, 'Jan/21', 'TSL', 'SP', 'Value', '84300', '1109563', 'Client_503', 'DAYS UPTO 60', '-0.112207882', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');
INSERT INTO public.collection VALUES (1, 'Jan/21', 'CHIPs', 'RM-East', 'EPS', '70002', '1109822', 'Client_87', 'ADVANCE', '-0.13275003', '-0.182396262', '-0.20835469', '0', '-0.208615454', 'Remarks from AM');
INSERT INTO public.collection VALUES (3, 'Jan/21', 'CHIPs', 'RM-East', 'EPS', '70002', '1109822', 'Client_87', 'DAYS ABOVE 180', '0.31578635', '-0.182396262', '-0.20835469', '0', '-0.208615434', 'Remarks from AM');


--
-- Data for Name: sap_dump; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: static_master; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.static_master VALUES (1, 'category', 'bu', 'region', 'services', 'acc_type', 'ec_nc', 'profit_center');


--
-- Data for Name: user_account; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.user_account VALUES (373, 'sham', 'ji', 'sham@ji.com', 'S4ieEiOGqJQKV6ire5b3', 2345678901, '', '', 'qw', 'qw', 'qw', 'qw', 1, NULL, '2021/03/24 12:03:57', NULL);
INSERT INTO public.user_account VALUES (375, 'Test', 'Test', 'test@mail.com', 'Ygemqc1Q6MtmM8BT1NVp', 9999, '', '', 'qw', 'qw', 'qw', 'qw', 1, NULL, '2021/03/24 12:03:06', NULL);
INSERT INTO public.user_account VALUES (376, 'Test 2', 'Test 2', 'test2@mail.com', '7dnV2RprWJNdAqhTlcuy', 999988, '', '', 'qw', 'qw', 'qw', 'qw', 1, NULL, '2021/03/24 12:03:10', NULL);
INSERT INTO public.user_account VALUES (1078, 'Siddharth', 'Nalwaya', 'siddnalw@gmail.com', 'Jg5`UkLgVUCfZnpiwowy', 2424161, 'AM', 'AM region', 'region', 'bu', 'category', 'a', 1, NULL, '2021/03/27 18:03:09', NULL);
INSERT INTO public.user_account VALUES (395, 'Test 2', 'Test 2', 'te2@mail.com', 'GjQNNTD4DPrZghs2tZKh', 9998, '', '', 'qw', 'qw', 'qw', 'qw', 1, NULL, '2021/03/24 12:03:48', NULL);
INSERT INTO public.user_account VALUES (1077, 'Siddharth', 'Nalwaya', 'sid@gmail.com', '12345678', 882424161, 'AM', 'AM region', 'region', 'bu', 'category', 'aSWxd', 0, NULL, '2021/03/27 16:03:09', NULL);
INSERT INTO public.user_account VALUES (1076, 'q2', 'q', 'q@q.q', '12345678', 1122334455, 'BU', 'BU region', 'region', 'bu', 'category', 'q', 0, '2021/03/26 17:38:18', '2021/03/26 17:03:08', '2021/03/30 16:03:55');
INSERT INTO public.user_account VALUES (1074, 'Siddharth', 'Nalwaya', 'sdnlw@gmail.com', '123456789', 9824241615, 'AM', 'AM region', 'region', 'bu', 'category', 'awsd', 0, '2021/03/30 22:17:45', '2021/03/25 15:03:00', NULL);
INSERT INTO public.user_account VALUES (1094, 'a', 'b', 'A@A.com', 'g4UhuOpRFSUZKzEfRE8Z', 1221122111, 'am', 'am q', 'q', 'q', 'q', '', 1, NULL, '2021/03/31 00:03:18', NULL);
INSERT INTO public.user_account VALUES (1095, 'a', 'a', 'shivanshnlw@gmail.com', 'mc7uISEk8`u2lU167rE`', 1129094455, 'admin', 'admin w', 'w', 'sf', 'department', '', 1, NULL, '2021/03/31 00:03:24', NULL);
INSERT INTO public.user_account VALUES (1081, 'admin', '', 'admin@gmail.com', '123456789', 1, 'admin', '', '', '', '', '', 0, '2021/03/31 10:45:04', '', '');


--
-- Name: clients_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.clients_id_seq', 19, true);


--
-- Name: collection_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.collection_id_seq', 1259, true);


--
-- Name: static_master_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.static_master_id_seq', 1, true);


--
-- Name: user_account_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.user_account_id_seq', 1095, true);


--
-- Name: user_account user_account_email_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_account
    ADD CONSTRAINT user_account_email_key UNIQUE (email);


--
-- Name: user_account user_account_mnumber_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_account
    ADD CONSTRAINT user_account_mnumber_key UNIQUE (mnumber);


--
-- Name: user_account user_account_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_account
    ADD CONSTRAINT user_account_pkey PRIMARY KEY (id);


--
-- PostgreSQL database dump complete
--

