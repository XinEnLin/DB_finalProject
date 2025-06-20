# �W�g�p���M��

## �M��²��

���M�׬��@�Ӿ�X **PHP + SQL Server + Session** ��ݻP **Vue 3 + Vite** �e�ݪ��ʪ��t�ΡA�䴩�ӫ~�s���B�ʪ����޲z�B�n�J���ҡB�q��޲z�B�޲z�̫�x�BPDF �o���U�����\��C

---

##  �M�ץؿ����c

```plaintext
DB_FinalProject/
�u�w�w backend/                      # PHP ��� API �P�޿�
�x   �u�w�w api/                      # API ���I�]�ѫe�ݩI�s�^
�x   �x   �u�w�w auth/                 # �ϥΪ����� API
�x   �x   �x   �u�w�w login.php
�x   �x   �x   �u�w�w logout.php
�x   �x   �x   �|�w�w register.php
�x   �x   �u�w�w cart/                 # �ʪ������� API
�x   �x   �x   �u�w�w add_cart.php
�x   �x   �x   �u�w�w checkout_cart.php
�x   �x   �x   �u�w�w clear_cart.php
�x   �x   �x   �u�w�w delete_cart.php
�x   �x   �x   �u�w�w list_cart.php
�x   �x   �x   �|�w�w update_cart.php
�x   �x   �u�w�w order/                # �q����� API
�x   �x   �x   �u�w�w boss_orders.php
�x   �x   �x   �u�w�w update_order_status.php
�x   �x   �x   �|�w�w user_orders.php
�x   �x   �|�w�w products/             # �ӫ~�W�� API�]���^
�x
�x   �u�w�w config/                   # �]�w��
�x   �x   �|�w�w db.php                # ��Ʈw�s�u�]�w
�x
�x   �u�w�w controllers/             # ����]��z�޿�y�{�^
�x   �x   �u�w�w CartController.php
�x   �x   �u�w�w OrderController.php
�x   �x   �|�w�w ProductController.php
�x
�x   �|�w�w models/                  # ��ƾާ@�ҫ�
�x       �u�w�w Cart.php
�x       �u�w�w Order.php
�x       �u�w�w OrderItem.php
�x       �u�w�w Product.php
�x       �|�w�w User.php
�x
�u�w�w frontend/                    # Vue �e������
�x   �u�w�w public/                  # ���@�귽
�x   �x   �u�w�w images/              # �R�A�Ϥ��귽
�x   �x   �|�w�w icons/               # ���� favicon�B�ϥܵ�
�x
�x   �u�w�w src/
�x   �x   �u�w�w assets/              # CSS�B�Ϥ����귽
�x   �x   �u�w�w components/          # �i���Τ���]�ثe���š^
�x   �x   �u�w�w router/              # Vue Router �]�w
�x   �x   �x   �|�w�w index.js
�x   �x   �u�w�w views/               # �U��������
�x   �x   �x   �u�w�w Cart.vue
�x   �x   �x   �u�w�w Login.vue
�x   �x   �x   �u�w�w ManageOrders.vue
�x   �x   �x   �u�w�w ManageProducts.vue
�x   �x   �x   �u�w�w Order.vue
�x   �x   �x   �u�w�w ProductList.vue
�x   �x   �x   �|�w�w Register.vue
�x   �x   �u�w�w App.vue              # �����D�ج[
�x   �x   �|�w�w main.js              # Vue app �J�f
�x
�x   �u�w�w package.json             # npm �̻ۨP�Ұʸ}��
�x   �|�w�w vite.config.js           # Vite �]�w
�x
�u�w�w .gitignore
�u�w�w package-lock.json
�u�w�w README.md                    # �������

```

---

## �\��Ҳջ���
| �Ҳ�             | �޳N         | ����                                     |
|------------------|--------------|------------------------------------------|
| �n�J / ���U�t��  | PHP + Session | �䴩�b���n�J���ҡB�����v������           |
| �ӫ~�s��         | Vue �e��     | Vue Router �޲z���ѡA�ӫ~�H�d���覡�i�� |
| �ʪ����\��       | Session + API | �i�[�J�B�ק�ƶq�B�R���B���b             |
| �q��O��         | Vue + API    | �䴩�U�Ȭd�ݭq��A�޲z�̧�s�X�f���A     |
| �޲z��x         | Vue + API    | �޲z�ӫ~�]CRUD�^�P�q�檬�A�ܧ�           |
| PDF �o���U��     | jsPDF        | �ѨϥΪ̺ݴ�V�q�椺�e�äU���� PDF        |
| �e�������ʵe     | CSS + Vue    | �ϥ� `<transition>` ��{�H�J�H�X�ĪG     |

---

##  �}�o��x

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
| 2025/06/15  | ������ Vue Router �[�c          | �䴩���ѻP�n�J��ɦV             |
| 2025/06/16  | �걵 API ��ܰӫ~�P�[�J�ʪ���     | �ӫ~�d������ + Vue ref �]�w     |
| 2025/06/17  | �ʪ����޿觹��                     | �W�[ / �R�� / �M�� / ���b       |
| 2025/06/18  | �q�歶������ + ���X���Ӥ���        | �i�}/���X�C�� + ���Ƽ˦�        |
| 2025/06/19  | �[�J�o�� PDF �U��                  | �ϥ� html2canvas + jsPDF         |
| 2025/06/20  | �����[�J����ʵe�P header ����     | `<transition>` + scoped CSS     |

---



##  �ϥΤ覡

1. �w�����ҡG�ݦ� Apache + PHP + SQL Server
2. �e�ݫظm�G
   ```bash
   cd frontend
   npm install
   npm run dev -- --host
3. �פJ��ݸ�Ʈw�]database.sql�^

4. �s���e�ݡGhttp://localhost:5173/

---

## ? �}�o�̳Ƶ�

- ��ƨϥ� `$_SESSION` �޲z�ʪ������A
- ��ƪ��c�P�ؤl��ƫ�ĳ�t�~�ƥ��� `database.sql`
- �i�f�t JavaScript �W�[�e�ݤ��ʩ�

