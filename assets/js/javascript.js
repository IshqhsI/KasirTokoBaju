function myPrint() {
  var divContents = document.getElementById('invoice').innerHTML;
  var a = window.open('', '', 'height=500, width=500');
  a.document.write('<html>');
  a.document.write('<body > <h1>Div contents are <br>');
  a.document.write();
  a.document.write('</body></html>');
  a.document.close();
  a.print();
}

function number_format(number, decimals, dec_point, thousands_sep) {
  number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = typeof thousands_sep === 'undefined' ? ',' : thousands_sep,
    dec = typeof dec_point === 'undefined' ? '.' : dec_point,
    s = '',
    toFixedFix = function (n, prec) {
      var k = Math.pow(10, prec);
      return '' + (Math.round(n * k) / k).toFixed(prec);
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}

function str_replace(search, replace, subject, count) {
  var i = 0,
    j = 0,
    temp = '',
    repl = '',
    sl = 0,
    fl = 0,
    f = [].concat(search),
    r = [].concat(replace),
    s = subject,
    ra = Object.prototype.toString.call(r) === '[object Array]',
    sa = Object.prototype.toString.call(s) === '[object Array]';
  s = [].concat(s);
  if (count) {
    this.window[count] = 0;
  }

  for (i = 0, sl = s.length; i < sl; i++) {
    if (s[i] === '') {
      continue;
    }
    for (j = 0, fl = f.length; j < fl; j++) {
      temp = s[i] + '';
      repl = ra ? (r[j] !== undefined ? r[j] : '') : r[0];
      s[i] = temp.split(f[j]).join(repl);
      if (count && s[i] !== temp) {
        this.window[count] += (temp.length - s[i].length) / f[j].length;
      }
    }
  }
  return sa ? s : s[0];
}

$(function () {
  bsCustomFileInput.init();
  $('#example1')
    .DataTable({
      responsive: true,
      lengthChange: false,
      autoWidth: false,
      buttons: ['copy', 'csv', 'excel', 'pdf', 'print', 'colvis'],
    })
    .buttons()
    .container()
    .appendTo('#example1_wrapper .col-md-6:eq(0)');
  $('#example2').DataTable({
    paging: true,
    lengthChange: false,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: false,
    responsive: true,
  });

  //
  $('select#kodeBarang').change(function () {
    const kodeBarang = $(this).val();

    $.ajax({
      url: 'http://localhost:8080/int2sbd/c4e/barang/getbarang.php',
      data: {
        kodeBarang: kodeBarang,
      },
      method: 'post',
      dataType: 'json',
      success: function (data) {
        namaBarang = data.nama_barang;
        harga = data.harga;
        hargaBarang = number_format(harga, 2, ',', '.');

        $('#namaBarang').val(data.nama_barang);
        $('#harga').val(data.harga);
        $('#hargaBarang').val('Rp. ' + hargaBarang);
      },
    });
  });

  // Get Kembalian
  $('#pembayaran').focusout(function () {
    harga = parseInt($('#totalharga').val());
    bayar = $(this).val();
    bayar = str_replace(',', '', bayar);
    console.info(bayar);
    console.log(harga);

    if (bayar > harga) {
      kembalian = bayar - harga;
      $('#kembalian').val(kembalian);
      kembalian = number_format(kembalian, 2, ',', '.');
      kembalian = 'Rp. ' + kembalian;
      $('#kembalian2').val(kembalian);
    } else if (bayar == harga) {
      $('#kembalian').val(0);
      $('#kembalian2').val('Pas Duitnya');
    } else {
      $('#kembalian2').val('Terima Donasi Ginjal');
    }
  });

  //   $('input#pembayaran').keyup(function () {
  $('input#pembayaran').simpleMoneyFormat();
  // });

  // Alert
  $('a.confirm').click(function () {
    var getLink = $(this).attr('href');
    Swal.fire({
      title: 'Yang Beneeeer?',
      text: 'Nanti Nyesel Loh',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Hapusss !',
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = getLink;
      }
    });
    return false;
  });

  $('a.gantikasir').click(function () {
    const idKasir = $(this).data('id');

    $.ajax({
      url: 'http://localhost:8080/int2sbd/c4e/kasir/getkasir.php',
      data: {
        idKasir: idKasir,
      },
      method: 'post',
      dataType: 'json',
      success: function (data) {
        namaKasir = data.nama_kasir;
        alamat = data.alamat;
        $('select#idKasir').val(idKasir);
        $('#namaKasir').val(namaKasir);
        $('#alamat').val(alamat);
      },
    });
  });

  // Ganti Kasir
  $('select#idKasir').change(function () {
    const idKasir = $(this).val();

    $.ajax({
      url: 'http://localhost:8080/int2sbd/c4e/kasir/getkasir.php',
      data: {
        idKasir: idKasir,
      },
      method: 'post',
      dataType: 'json',
      success: function (data) {
        namaKasir = data.nama_kasir;
        alamat = data.alamat;

        $('#namaKasir').val(namaKasir);
        $('#alamat').val(alamat);
      },
    });
  });
});
