const puppeteer = require('puppeteer');

(async () => {
  const browser = await puppeteer.launch();
  const page = await browser.newPage();
  var response = await page.goto('http://example.com/', {
    waitUntil: 'load',
  });
  console.log(response);

  await browser.close();
})();