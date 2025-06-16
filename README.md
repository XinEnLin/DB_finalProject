# �ʪ��t�ζ}�o����

## �M��²��

���M�׬��@�ӥH PHP + SQL + Session �}�o��²���ʪ��t�ΡA�䴩�ӫ~�s���B�ʪ����޲z�B�n�J���һP��x�ӫ~�޲z�\��C

---

##  �M�ץؿ����c
������plaintext
? DB_FinalProject/
�u�w�w asset/
�x   �u�w�w css/
�x   �x   �|�w�w style.css
�x   �u�w�w images/
�x   �|�w�w js/
�x       �|�w�w main.js
�u�w�w config/
�x   �|�w�w db.php                      # ��Ʈw�s�u�]�w
�u�w�w layouts/                        # �����ج[�P�G��
�x   �|�w�w �]�i�إ� admin_layout.php / index_layout.php�^
�u�w�w public/                         # �e�x�P��x�����J�f
�x   �u�w�w boss_dashboard.php
�x   �u�w�w index.php
�x   �u�w�w list_cart.php
�x   �u�w�w list_product.php
�x   �u�w�w login.php
�x   �u�w�w logout.php
�x   �u�w�w register.php
�x   �|�w�w test.php
�u�w�w src/                            # �{���޿�P��ƳB�z���O
�x   �u�w�w Cart.php
�x   �u�w�w Order.php
�x   �u�w�w OrderItem.php
�x   �u�w�w Product.php
�x   �|�w�w User.php
�u�w�w README.md
������

---

## ? �\��Ҳջ���

| �Ҳ�            | ����                         |
|-----------------|------------------------------|
| `index.php`     | ��ܰӫ~�åi�[�J�ʪ���       |
| `Cart.php`      | �޲z�ʪ������[�J�P�����޿�   |
| `list_cart.php` | ����ʪ����ӫ~�M��           |
| `boss_dashboard.php` | �޲z�ӫ~���s�W�B�s��B�R�� |
| `Product.php`   | �t�d�ӫ~�� CRUD �ާ@         |

---

## ? �}�o��x

| ���        | ����                       | �Ƶ�                           |
|-------------|----------------------------|--------------------------------|
| 2025/05/10  | �إ� `index.php` �ӫ~�M�歶 | �q��Ʈw����ơA��ܥd���˦� |
| 2025/05/11  | �����[�J�ʪ����\��         | �ϥ� `$_SESSION['cart']` �x�s |
| 2025/05/12  | �s�W `list_cart.php`        | �i��ܡB�R���ʪ�������       |
| 2025/05/12  | ���c�ӫ~�޲z���ҲդƬ[�c   | ��� `add`, `edit`, `list`    |
| 2025/05/13  | �ץ��ʪ����������İ��D     | �T�{ `productID` �ǻ��P���O   |
| 2025/05/14  | �ϥΪ̡B�ӫ~�B��O�޲z�B�ʪ����j�P�g�n�A���U�Ӷ}�l���ơA�ثe���I�d��     |    |
| 2025/05/16  | �ʪ�����bug     |    |
| 2025/05/19  | �[�J�ʪ�����fatal error
| 2025/05/21  | �[�J�ʪ������\�A�ʪ����٦�bug
---

## ? �ݿ�M��

 ? TODO �}�o���ء]2024-05-13�^

- [ ] ? �ˬd�n�X�����޿�G
  - �n�X�ثe�ϥ� `index.php?action=logout`�A�z�L `User::logout()` ��@
  - ��ĳ�ʸˬ���W `logout.php` �ɮס]�i��^

- [ ] ?? �������ܰT���u�ơG
  - ���U���\�B�n�J���\���ϥ� `$_SESSION['message']` �Τ@�B�z���
  - �i��X `partials/message.php` ��ܤ@����۰ʮ���

- [ ] ? �[�J�ʪ����� UI ���X�G
  - �i��ܡu? �w�[�J�ʪ����v�T��
  - �αN�ʪ����ƶq��ܦb�����k�W��

- [ ] ? ���c session ���c�P�n�J���A�ˬd�G
  - �إ� `User::isLoggedIn()` ��k�w����
  - �Ҧ��ݵn�J�����]�p�ʪ����B���b�B�|�����ߡ^�����ҵn�J���A

- [ ] ? �n�J��۰ʱa�J�ϥΪ̸�ơ]email / �a�} / �q�ܡ^
  - �i�z�L `$_SESSION['user']` �x�s�����T�A��֬d�ߦ���
  
- [ ]  boss mode�U�b�����n�i�H�^��dashboard


## ? �ϥΤ覡

1. �w�� Apache + PHP + MySQL ���ҡ]��ĳ�ϥ� XAMPP�^
2. �N�M�ש�J `htdocs/` �ؿ��U
3. �פJ��Ʈw�}���]�Y���^
4. �i�J�����G [http://localhost/DB_finalProject/public/index.php](http://localhost/DB_finalProject/public/index.php)

---

## ? �}�o�̳Ƶ�

- ��ƨϥ� `$_SESSION` �޲z�ʪ������A
- ��ƪ��c�P�ؤl��ƫ�ĳ�t�~�ƥ��� `database.sql`
- �i�f�t JavaScript �W�[�e�ݤ��ʩ�

