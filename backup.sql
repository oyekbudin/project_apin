PGDMP     5        	            }            project_apin    9.6.1    9.6.1 9    �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false            �           1262    16393    project_apin    DATABASE     �   CREATE DATABASE project_apin WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Indonesian_Indonesia.1252' LC_CTYPE = 'Indonesian_Indonesia.1252';
    DROP DATABASE project_apin;
             postgres    false                        2615    2200    public    SCHEMA        CREATE SCHEMA public;
    DROP SCHEMA public;
             postgres    false            �           0    0    SCHEMA public    COMMENT     6   COMMENT ON SCHEMA public IS 'standard public schema';
                  postgres    false    3                        3079    12387    plpgsql 	   EXTENSION     ?   CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;
    DROP EXTENSION plpgsql;
                  false            �           0    0    EXTENSION plpgsql    COMMENT     @   COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';
                       false    1            �            1259    17028    users    TABLE     �   CREATE TABLE users (
    id integer NOT NULL,
    name character varying(100) NOT NULL,
    registerdate timestamp without time zone DEFAULT now(),
    loginstatus boolean DEFAULT false
);
    DROP TABLE public.users;
       public         postgres    false    3            �            1259    17040    administrator    TABLE     �   CREATE TABLE administrator (
    idadmin integer NOT NULL,
    adminname character varying(100) NOT NULL,
    role character varying(50),
    password text NOT NULL
)
INHERITS (users);
 !   DROP TABLE public.administrator;
       public         postgres    false    186    3            �            1259    17038    administrator_idadmin_seq    SEQUENCE     {   CREATE SEQUENCE administrator_idadmin_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.administrator_idadmin_seq;
       public       postgres    false    3    188            �           0    0    administrator_idadmin_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE administrator_idadmin_seq OWNED BY administrator.idadmin;
            public       postgres    false    187            �            1259    17064    infaq    TABLE     �   CREATE TABLE infaq (
    id integer NOT NULL,
    name character varying(50) NOT NULL,
    kelas character varying(3) NOT NULL,
    harga integer NOT NULL
);
    DROP TABLE public.infaq;
       public         postgres    false    3            �            1259    17062    infaq_id_seq    SEQUENCE     n   CREATE SEQUENCE infaq_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.infaq_id_seq;
       public       postgres    false    191    3            �           0    0    infaq_id_seq    SEQUENCE OWNED BY     /   ALTER SEQUENCE infaq_id_seq OWNED BY infaq.id;
            public       postgres    false    190            �            1259    17074 
   pembayaran    TABLE       CREATE TABLE pembayaran (
    id integer NOT NULL,
    date timestamp without time zone DEFAULT now(),
    idsiswa integer NOT NULL,
    idinfaq integer NOT NULL,
    nominal integer,
    payment_method character varying(10) DEFAULT 'manual'::character varying NOT NULL,
    order_id character varying(50),
    payment_type character varying(50),
    status character varying(15) DEFAULT 'pending'::character varying,
    transaction_time timestamp without time zone,
    fraud_status character varying(20),
    snap_token text,
    CONSTRAINT pembayaran_nominal_check CHECK ((nominal >= 0)),
    CONSTRAINT pembayaran_payment_method_check CHECK (((payment_method)::text = ANY ((ARRAY['manual'::character varying, 'midtrans'::character varying])::text[]))),
    CONSTRAINT pembayaran_status_check CHECK (((status)::text = ANY ((ARRAY['pending'::character varying, 'settlement'::character varying, 'expire'::character varying, 'cancel'::character varying, 'deny'::character varying, 'refund'::character varying])::text[])))
);
    DROP TABLE public.pembayaran;
       public         postgres    false    3            �            1259    17072    pembayaran_id_seq    SEQUENCE     s   CREATE SEQUENCE pembayaran_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.pembayaran_id_seq;
       public       postgres    false    3    193            �           0    0    pembayaran_id_seq    SEQUENCE OWNED BY     9   ALTER SEQUENCE pembayaran_id_seq OWNED BY pembayaran.id;
            public       postgres    false    192            �            1259    17101    pesanwa    TABLE     �   CREATE TABLE pesanwa (
    id integer NOT NULL,
    jenis character varying(50) NOT NULL,
    pesan text NOT NULL,
    updated_at timestamp without time zone DEFAULT now()
);
    DROP TABLE public.pesanwa;
       public         postgres    false    3            �            1259    17099    pesanwa_id_seq    SEQUENCE     p   CREATE SEQUENCE pesanwa_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.pesanwa_id_seq;
       public       postgres    false    195    3            �           0    0    pesanwa_id_seq    SEQUENCE OWNED BY     3   ALTER SEQUENCE pesanwa_id_seq OWNED BY pesanwa.id;
            public       postgres    false    194            �            1259    17054    siswa    TABLE     �   CREATE TABLE siswa (
    nis integer NOT NULL,
    phonenumber character varying(15) NOT NULL,
    gender character varying(1) NOT NULL,
    kelas character varying(1) NOT NULL
)
INHERITS (users);
    DROP TABLE public.siswa;
       public         postgres    false    3    186            �            1259    17026    users_id_seq    SEQUENCE     n   CREATE SEQUENCE users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.users_id_seq;
       public       postgres    false    3    186            �           0    0    users_id_seq    SEQUENCE OWNED BY     /   ALTER SEQUENCE users_id_seq OWNED BY users.id;
            public       postgres    false    185            �           2604    17043    administrator id    DEFAULT     ^   ALTER TABLE ONLY administrator ALTER COLUMN id SET DEFAULT nextval('users_id_seq'::regclass);
 ?   ALTER TABLE public.administrator ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    188    188    185            �           2604    17044    administrator registerdate    DEFAULT     L   ALTER TABLE ONLY administrator ALTER COLUMN registerdate SET DEFAULT now();
 I   ALTER TABLE public.administrator ALTER COLUMN registerdate DROP DEFAULT;
       public       postgres    false    188    188            �           2604    17045    administrator loginstatus    DEFAULT     K   ALTER TABLE ONLY administrator ALTER COLUMN loginstatus SET DEFAULT false;
 H   ALTER TABLE public.administrator ALTER COLUMN loginstatus DROP DEFAULT;
       public       postgres    false    188    188            �           2604    17046    administrator idadmin    DEFAULT     p   ALTER TABLE ONLY administrator ALTER COLUMN idadmin SET DEFAULT nextval('administrator_idadmin_seq'::regclass);
 D   ALTER TABLE public.administrator ALTER COLUMN idadmin DROP DEFAULT;
       public       postgres    false    187    188    188            �           2604    17067    infaq id    DEFAULT     V   ALTER TABLE ONLY infaq ALTER COLUMN id SET DEFAULT nextval('infaq_id_seq'::regclass);
 7   ALTER TABLE public.infaq ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    190    191    191            �           2604    17077    pembayaran id    DEFAULT     `   ALTER TABLE ONLY pembayaran ALTER COLUMN id SET DEFAULT nextval('pembayaran_id_seq'::regclass);
 <   ALTER TABLE public.pembayaran ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    192    193    193                       2604    17104 
   pesanwa id    DEFAULT     Z   ALTER TABLE ONLY pesanwa ALTER COLUMN id SET DEFAULT nextval('pesanwa_id_seq'::regclass);
 9   ALTER TABLE public.pesanwa ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    195    194    195            �           2604    17057    siswa id    DEFAULT     V   ALTER TABLE ONLY siswa ALTER COLUMN id SET DEFAULT nextval('users_id_seq'::regclass);
 7   ALTER TABLE public.siswa ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    189    185    189            �           2604    17058    siswa registerdate    DEFAULT     D   ALTER TABLE ONLY siswa ALTER COLUMN registerdate SET DEFAULT now();
 A   ALTER TABLE public.siswa ALTER COLUMN registerdate DROP DEFAULT;
       public       postgres    false    189    189            �           2604    17059    siswa loginstatus    DEFAULT     C   ALTER TABLE ONLY siswa ALTER COLUMN loginstatus SET DEFAULT false;
 @   ALTER TABLE public.siswa ALTER COLUMN loginstatus DROP DEFAULT;
       public       postgres    false    189    189            �           2604    17031    users id    DEFAULT     V   ALTER TABLE ONLY users ALTER COLUMN id SET DEFAULT nextval('users_id_seq'::regclass);
 7   ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    185    186    186            �          0    17040    administrator 
   TABLE DATA               i   COPY administrator (id, name, registerdate, loginstatus, idadmin, adminname, role, password) FROM stdin;
    public       postgres    false    188   �?       �           0    0    administrator_idadmin_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('administrator_idadmin_seq', 1, true);
            public       postgres    false    187            �          0    17064    infaq 
   TABLE DATA               0   COPY infaq (id, name, kelas, harga) FROM stdin;
    public       postgres    false    191   e@       �           0    0    infaq_id_seq    SEQUENCE SET     4   SELECT pg_catalog.setval('infaq_id_seq', 24, true);
            public       postgres    false    190            �          0    17074 
   pembayaran 
   TABLE DATA               �   COPY pembayaran (id, date, idsiswa, idinfaq, nominal, payment_method, order_id, payment_type, status, transaction_time, fraud_status, snap_token) FROM stdin;
    public       postgres    false    193   dA       �           0    0    pembayaran_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('pembayaran_id_seq', 584, true);
            public       postgres    false    192            �          0    17101    pesanwa 
   TABLE DATA               8   COPY pesanwa (id, jenis, pesan, updated_at) FROM stdin;
    public       postgres    false    195   �O       �           0    0    pesanwa_id_seq    SEQUENCE SET     6   SELECT pg_catalog.setval('pesanwa_id_seq', 1, false);
            public       postgres    false    194            �          0    17054    siswa 
   TABLE DATA               ^   COPY siswa (id, name, registerdate, loginstatus, nis, phonenumber, gender, kelas) FROM stdin;
    public       postgres    false    189   �O       �          0    17028    users 
   TABLE DATA               =   COPY users (id, name, registerdate, loginstatus) FROM stdin;
    public       postgres    false    186   �T       �           0    0    users_id_seq    SEQUENCE SET     4   SELECT pg_catalog.setval('users_id_seq', 67, true);
            public       postgres    false    185            	           2606    17053 )   administrator administrator_adminname_key 
   CONSTRAINT     b   ALTER TABLE ONLY administrator
    ADD CONSTRAINT administrator_adminname_key UNIQUE (adminname);
 S   ALTER TABLE ONLY public.administrator DROP CONSTRAINT administrator_adminname_key;
       public         postgres    false    188    188                       2606    17051     administrator administrator_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY administrator
    ADD CONSTRAINT administrator_pkey PRIMARY KEY (idadmin);
 J   ALTER TABLE ONLY public.administrator DROP CONSTRAINT administrator_pkey;
       public         postgres    false    188    188                       2606    17071    infaq infaq_name_key 
   CONSTRAINT     H   ALTER TABLE ONLY infaq
    ADD CONSTRAINT infaq_name_key UNIQUE (name);
 >   ALTER TABLE ONLY public.infaq DROP CONSTRAINT infaq_name_key;
       public         postgres    false    191    191                       2606    17069    infaq infaq_pkey 
   CONSTRAINT     G   ALTER TABLE ONLY infaq
    ADD CONSTRAINT infaq_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.infaq DROP CONSTRAINT infaq_pkey;
       public         postgres    false    191    191                       2606    17088    pembayaran pembayaran_pkey 
   CONSTRAINT     Q   ALTER TABLE ONLY pembayaran
    ADD CONSTRAINT pembayaran_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.pembayaran DROP CONSTRAINT pembayaran_pkey;
       public         postgres    false    193    193                       2606    17112    pesanwa pesanwa_jenis_key 
   CONSTRAINT     N   ALTER TABLE ONLY pesanwa
    ADD CONSTRAINT pesanwa_jenis_key UNIQUE (jenis);
 C   ALTER TABLE ONLY public.pesanwa DROP CONSTRAINT pesanwa_jenis_key;
       public         postgres    false    195    195                       2606    17110    pesanwa pesanwa_pkey 
   CONSTRAINT     K   ALTER TABLE ONLY pesanwa
    ADD CONSTRAINT pesanwa_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.pesanwa DROP CONSTRAINT pesanwa_pkey;
       public         postgres    false    195    195                       2606    17061    siswa siswa_pkey 
   CONSTRAINT     H   ALTER TABLE ONLY siswa
    ADD CONSTRAINT siswa_pkey PRIMARY KEY (nis);
 :   ALTER TABLE ONLY public.siswa DROP CONSTRAINT siswa_pkey;
       public         postgres    false    189    189                       2606    17037    users users_name_key 
   CONSTRAINT     H   ALTER TABLE ONLY users
    ADD CONSTRAINT users_name_key UNIQUE (name);
 >   ALTER TABLE ONLY public.users DROP CONSTRAINT users_name_key;
       public         postgres    false    186    186                       2606    17035    users users_pkey 
   CONSTRAINT     G   ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public         postgres    false    186    186                       2606    17094 "   pembayaran pembayaran_idinfaq_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY pembayaran
    ADD CONSTRAINT pembayaran_idinfaq_fkey FOREIGN KEY (idinfaq) REFERENCES infaq(id) ON UPDATE CASCADE;
 L   ALTER TABLE ONLY public.pembayaran DROP CONSTRAINT pembayaran_idinfaq_fkey;
       public       postgres    false    193    2065    191                       2606    17089 "   pembayaran pembayaran_idsiswa_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY pembayaran
    ADD CONSTRAINT pembayaran_idsiswa_fkey FOREIGN KEY (idsiswa) REFERENCES siswa(nis) ON UPDATE CASCADE ON DELETE CASCADE;
 L   ALTER TABLE ONLY public.pembayaran DROP CONSTRAINT pembayaran_idsiswa_fkey;
       public       postgres    false    2061    189    193            �   �   x�˻�0 ���+���+Ud�h��������J�`����0�κ��`�Z��
�Y�ܳ��G���5w=���s1�r��D�ǲ�Vw@q�ܡ�
�}�M�I�f2�_��2���Ȕ<���G(�����9��Ӽ�Rrc��}�*k      �   �   x�]�Mn�0��p
N�N`IT5R�&Raٍ�Fj
��{��q���{���޺���J���dl�~v~N�`o�8���&I����MkW���{{`�����?�G�m�����z�	j޴%���8���#e۔� �s	�Jhڮ��B��`��T��`�k����'�I�a:m����
�ѫ?�+��B�A;=�ޔ��2u��C��*��(�]��F+������ ߒ<��@J}�,���z�      �   =  x���M��DǷW���Dɋ�
zb�F id��G�}�a�s����p�T�G�>�W=���h���e�V�o��u�������*�>��x�����߯￯���ǟ���ϯ�}��[%��d�4%��j�%C:#�T�pN�qg��{8�t%s��P2� ���ҙN�\_��+���t�ˏ'�fvn.h���\��M~^���U��M~`,��V��M~b,��'V����<}j!��#ԝx�:�x���k��Տ��2o\}˯���o[��շ�����_YW�֌\}[36p��=Բ���a��l�b��-���yb6u��l�U�N6����M�踡�gS?:n6Գ�7��ҏ��u0t���Άv���h9�`�.?���z����g����~DS_,뢫���G����E[/�=�2�(���s�}}CE__k����K�}gg���q�㌶^:�t���S��L}��q��OY:N��)K�	�>e�8�Ч-'�9z��e�hi��N��'��Na'��k�B��{�Ξ�!���~H�m�X���v�x���b�c����֋�l�����9u �l�Vt�(�z��:���GG��l�5���l�G���;[��qu�Ζ~t\����W����G���;z�����}��e����r����r�x�*����[��@gۺX4w���[��r���!���v�X0�^\�\���� �뭌�)�U�j�dθ����%�ƫ؅qɨq	I��Y�r%�dָ�\�-�5.!I�3k\B3����dڸ�$hθq	IҜy�6�D͙8n%�����4w���߆,�:n%Y}3v�J��fl���q'��d�x��+S��/;�e��������C\�KHq�?.!9�e�x=��2~\B�,���C\�K�q�@n%��� ��4w��[Iq�Cn%9�e�����a�z���^�G^��v3���J���ɫ>����~��~&���V�o�R�x���d,���S,�ɒX��%��#$K
p�GH�����,)�%!YR K>B�� �\��%��R�'4�۶� �|���'����܀O>B�s@����#$?7@����� QV����= H���D 0咒[q�)�+=)�SN8�dP9?�Ȥr�� %��y����*���*��P2�\Br@ɰr	�%��%$��+��P2�\B�~g\��d�θr	���y�6��ߙXn%h@o������ǸJ�[IV�L.������r+I���V��)�-e�SF�[J��0�h)�S��[��.��#��r�T3ŜJ2Ŝ��P�s�W��m�����{jF�S�繁`N}��f~9�	�������L/���]ex��\�].!W|kF�K�ߚ��6�+�5�˭$����V����r��5����|��r���`N��k&��s������f�9=.�a��KJF���������f�9=)�a�HA�sV��e���dv6{��c�5�%$+f&�KHV�L0�����`.!T����ld�s	Ɋ�	��3�mHY13��J�ۙ`n%i�L0��r5��\�s�KnV3�\Jr�T3��Jr�����ƫ)%���V2�_N�L�f~9u;�����Ce��KH��^.!9Tfz9}�f|���w���|�*�L ��%��e�����W��U3��J�Ae����U�sKI#d�9��T�W��#������2��JU��
(Sgw*�Lީ�2uz��|���Q�Y�H(Swè 2u;�
S�è��1*�-uG�
qK��Bܲ쪢f:�,>�_!p���"�KI�B�KI�'�].%�	���]�P	��������� |Y�yx�J�<<j�_��/R�KI�<�a��$�%$1���Mp��|�[)�Dͬ�j̬�YJ�,s7��?	6��a�
(��äHf��I�̢G� �����`'E��Fa̩���4e�����(���K4Jb��e�����D0S/z�L����@3��R
�Fᴽ�eV�iрe~��X�'�fzk��<��l�y��yL��AS7�m���r�1u��YL�#�AS7�m��<�P	Ạ������6Hb./ɵo�Y��(��srX�ag�X�g��2=#�y�!��C/�����-�#�q��uo���ma��4J�´W4cV{�A�(��֠qS�
bګ1�����~GALO�%15�iŬ�� �����L�T�L�T�L�T�L�ʨ�|�jjF��q	8���b�q	 ���a�q	���`V�B[&�[I��2�\ی� p�=�2¼�A�	���r7̭�px��������s+�߄�V���Mc�æ�ҕ�4VK�3�6�� �Y�61�ަ� ��`	����<���%x��?x�2��?��� s+�x�w3xg��ڙ_.!��fz���uO��i�`�ދ�K�&��������i�˥T�L���R#zY�C�����(��/׵v)ס���С���С����_�N���_�N襏�w��>�ܡ��;�m惝襾W����b%�bꛕ(��G�NQ̲��U�&��{c��j���ז��u
c�R0�nl�0����)�i;~u�|�N��u�b�xY�$���u
b�xY��a�=:�0��Qs�Ĺ���2t�a�	��-���l�{,���ލ8�6��/m������e�G�:�˲�b ��3�o¤���t��>G�!��s�Ҙ>��!��Nd�� Ҙz�CS�u�b�}�Q�nq��\\q�
e1��S�i��0���sx�C� ��x��[�,�/z��l�7yu◖�u◖�u◖�u�����A}�$�mP�)�i�wJa��֝R��=�Ӂ`���Sov �Ş� 0�=?؁_�w���"��7�{&��S#=3��O���0��\� ¬��R2!�[�qR�ST
b^�8Q�z�]��K�;��\v����j'��b���m�ީ��3&Bݩ���)��u���:Bݡ���Pwh(��)�0�ݼ�CCٲ{s(�e�x��>����_��ĔE f�[{���[{�ܗ�b�2�_g��N�v�1m'�N�va.!W	E0��A	L{�l�u��@Ġ��=1(iW��vE0(~iW����o����,�L/���,�L/����#��= �nv#�˭$����V��|��\/���}��)K�.�ܻ�f?�&�K��{�H�U�{�b�'�L/�w|���lq�`d|y�� #��[S����>񥼔��Q�����(mdvy�Ӷ��.oMA�K�	|dty?	
��R�((x�g��W͍�.oMSG&�KH~p\~���/�.����pf՟.܃Y���`V���̪��.�5փR���A�K��|P�R���wJ^�vC`P��߆<({i!��䥅���������Aw`N�����~)t�n�3�L�݂���S�Aaz
>�&���s�"�Ӯx���.v��S/v�"�S�x�&�S�x^���Ҿ8N��җEq_]�3�\B�ign�g��"D#s˯y�9j?�̢Y��X�6��bo1p	f��0`�Z�w�c?��5���)�{�o|W�^�?V����ձ��~����X�-p      �      x������ � �      �     x���Mr�8���)x��2�?�wpK��rBIq�5���L��x�
�x`��9�I�1^�}Y�'e���q�~�M��6���Yw��j���F]g��i�t�PݡR�1�3�6ZA��<�%�-Q�Q�:��9�-z�)\$LUb*5Ө~ =��}�� ީ.	5Ҫa%����z�-ꃄiJLÁtjp!0�F��Ֆ��#rj��\�^��) ϣ��JN�����o���B��.�ؕ�sT�>q���@×��1F]�������~��r����-P���Gx��0�zMV����ߗ�5Y��N��Fe��u@D7ڤ�R�80�I�}�E�0��H�R�&�״*��4�꿻���R�&K�t`4Cj)Z��"��M)`�l��X�z}����B�K��y�� ��>����^��pH��#(�I�I�}R ֨��T�3��6��0=�0l)c8�ְ��p_)^ED�`�l+��"�z=T�I�R�8�ju��=ڙA�.��*�J�<zm7�+�ᄩ�_V�y����cgq��Y�����k�!f���8v�'&]�N�c"��rw�&1���T���)�A���Y�cߢL]b���7� �tDorl*OB�Y���L�EJ$D["Z�2	��l����<��x{���H,0K�]�RV\Ir9�J�`^����Q���K�'L�}�:��P�-P��ըl��i�q�L�]��[��-��s�X�0Ν)��T���r�g�.$_�T0;8NAs��dhR�\�
4���_ ��ޑ�[���f��$�R��/�P���Ac�	)(yu��4�8&���'��T2{
���1i�_��-C����
�u����9S��q�"���_�,�����h����|�W�R>m�6�@�f�1�y�R� ������9�ń�R�6˿v�F�}�y�D�1.������Yˌ�LX��"��#���9�[�RzE_�ɡ���ٲ�l�ƨ;V)}�6��Ж�c�4Vѩ�^_ˌg������O8���G^_=�쓑�F�^��4��n� �f=��S�X�@�K���x��m��g�}�����a��	���z6�'�ɤ67cy�v(J��$��RN�v���cO�����t%��8ݞv+��c�NQ�m�n��8�P����=b�X�g�v3�v�dx��5OXi�D��]ܞ���r �J����	�M�a�5�V1�"6,I5������9�q	�T/[,>o�'�JZ�B� oJ�:�bR�г�N��ԛR�쬠t��ϫ�]���7�p�U�៟���?ü��      �      x������ � �     