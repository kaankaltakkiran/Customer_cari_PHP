# Customer_cari_PHP
 # Proje kullanım öyküsü
Customer cari web sayfası, kullanıcının üye olduktan sonra kendisine şirket hesabı açabilidiği bir web sayfadır. Kullanıcı açtığı bu şirket hesabı ile bu web site hizmetini kullanan diğer şirket hesapları arasında  **para alışverişi** yapabildiği bir hizmettir.

Grid yapılarında [datatablestan](https://datatables.net/) faydalandım. Aşşağıda bahsedildiği gibi bir çok özellik sağladı.

 ## Proje nasıl kullanılır?
- [ ] Proje clone edilir.
- [ ] Database klasöründe ki sql dosyası database import edilir.
- [ ] Projedeki db.php dosyasındaki bilgiler doğru şekilde doldurulur.
- [X] Kullanıma hazır.
      
   > **Note:**  Bu web sitesini, bu dosyadaki **kullanıcı giriş bilgileriyle**  veya **kendiniz oluşturduğunuz hesap bilgileri**  ile kullanabilirsiniz.

 ## Kullanıcı Bilgileri
 
Normal kullanıcı1= email= veli@gmail.com password= 123

Normal kullanıcı2= email= ahmet@gmail.com password= 123

Normal kullanıcı3= email= selin@gmail.com password= 123

 ## Yapılan Temel Geliştirmeler
- [X] Kullanıcı **Customer cari** hizmetini kullabilmesi için önce üye olması gerekir. Kullanıcı üye olduktan sonra index sayfasına yönlendirilir.
- [X] Anasayfa da kullanıcı şirket hesabı oluşturma bölümünü görür ve **Add Company** butonuna tıklayıp şirketini ekler.
- [X] Kullanıcı, şirketini başarıyla ekledikten sonra kendine ait şirket bilgilerini görür isterse **See My Company** butonuna tıklayarak şirket bilgilerini görebilir yada **Balance Transfer Action** butonuna tıklayarak para transfer işlemi gerçekleştirebilir.
- [X] Kullanıcı, **See My Company** butonuna tıklayarak şirket bilgilerini gördüğü sayfa açılır. Bu sayfada kullanıcı isterse şirket bilgilerini güncelleyebilir veya şirketini silebilir.
- [X] Kullanıcı, **Update** butonuna tıklayarak bilgilerini güncelleyebildiği sayfa açılır, **Delete** butonuna tıklayarak **alert** ile emin misiniz diye uyarıldıktan sonra şirketini silebilir.
- [X] Kullanıcı, eğer urlden başka id yazarsa başka kullanıcıların bilgilerini görüyordu. Kontrol eklenerek bu sorun giderildi.
- [X] Kullanıcı, **Balance Transfer Action** butonuna tıklayarak para transferi yapabilceği şirketleri görür. **Action** butonuna tıklayarak seçtiği şirkete para transferi yapacağı sayfaya yönlenir.
- [X] Kullanıcı, para transferi yapacağı kişinin bilgilerini görür. Daha sonra selectlisten kendi şirket hesabını seçerek dilediği miktarda para transferi yapabilir.
- [X] Kullanıcı, para miktari olarak 0 veya negatif bir değer girerse  **alert** ile uyarı mesajı çıkmaktadır.
- [X] Kullanıcı, **para transferi yaptıktan sonra** sağ üst menüde **Transaction History** sayfasını görür.Bu sayfada para transfer işlem geçmişini görür.
- [X] Kullanıcı, **Transaction History** sayfasında gördüğü işlem geçmişinde isterse arama, **pdf, excel, csv** türünde export alabilir. Ayrıca **copy** butonu ile kopyalayabilir işlem geçmişini, **print** ile çıktı alabilir. Sonra olarak **column visibility** ile istediği sütünu gösterebilir.
      
## Site Resimleri
 https://github.com/kaankaltakkiran/php_video

