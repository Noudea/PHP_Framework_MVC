
const money = document.querySelector('#mon');
const curr = document.querySelector('#cur');
const container = document.querySelector('.container');
const inp = document.querySelector('#input');
const conv = document.querySelector('#convert');


fetch('https://blockchain.info/ticker')
    .then(response => {
        console.log('Response:', response)
        return response.json();

    })
    .then((data) => {
        console.log(data.AUD)

        //1er facon


        for (const key in data) {
            opt = document.createElement('option');
            opt2 = document.createElement('option');
            opt.value = data[key].last;
            opt.innerHTML = key
            opt2.value = data[key].last
            opt2.innerHTML = key
            money.appendChild(opt);
            curr.appendChild(opt2);
            //appendchild = list vers le haut, add = list vers le bas
            // ou money.add(opt)
            //curr.add(opt2)
        }

        /**
         * effectue le calcul 
         */
        function calcul() {
            valeurBrute = inp.value * (money.value / curr.value)
            const pays = money.options[money.selectedIndex].text
            const symbol = data[pays].symbol
            conv.value = valeurBrute.toFixed(2) + symbol
        }
        inp.addEventListener('change', calcul)
        money.addEventListener('change', calcul)
        curr.addEventListener('change', calcul)






            //2eme facon


            // let deviseName = Object.keys(data)
            // let objAsArray = Object.values(data)
            // let innerobjasarray = Object.values(objAsArray)
            // console.log(deviseName)
            // console.log(objAsArray)
            // console.log(innerobjasarray)
            // for (let i = 0; i < Object.keys(data).length ; i++) {
            //     opt = document.createElement('option');
            //     opt2 = document.createElement('option');
            //     opt.value = objAsArray[i].last;
            //     opt2.value = objAsArray[i].last;
            //     opt.setAttribute('data-symbol',objAsArray[i].symbol)
            //     opt.innerHTML = deviseName[i];
            //     opt2.innerHTML = deviseName[i];
            //     money.appendChild(opt);
            //     curr.appendChild(opt2);
            // }
            //   inp.addEventListener('change', function () {
            //     valeurBrute = inp.value * (money.value / curr.value)
            //      const symbol = money.options[money.selectedIndex].getAttribute('data-symbol')
            //      console.log(symbol)
            //     conv.value = valeurBrute.toFixed(2) +symbol
            //     // text = sel.options[sel.selectedIndex].text;
            //     //   console.log(opt.value)
            //     //   console.log(opt2.value)
            //     //   console.log('success')
            //     //   console.log()
            //   })
            //   money.addEventListener('change', function () {
            //     valeurBrute = inp.value * (money.value / curr.value)
            //     const symbol = money.options[money.selectedIndex].getAttribute('data-symbol')
            //     console.log(symbol)
            //     conv.value = valeurBrute.toFixed(2) + symbol
            //     //    console.log(opt.value)
            //     //    console.log(opt2.value)
            //     //    console.log('success')
            //   })
            //   curr.addEventListener('change', function () {
            //     valeurBrute = inp.value * (money.value / curr.value)
            //      const symbol = money.options[money.selectedIndex].getAttribute('data-symbol')
            //      console.log(symbol)
            //     conv.value = valeurBrute.toFixed(2) +symbol
            //     //  console.log(opt.value)
            //     //  console.log(opt2.value)
            //     //  console.log('success')
            //   })




            .catch(error =>
                console.log(error)
            )
    })