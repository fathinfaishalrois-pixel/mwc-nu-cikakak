import {mkdir,copyFile} from 'node:fs/promises';
import {resolve} from 'node:path';
const root=process.cwd();
const out=resolve(root,'public/assets');
await mkdir(out,{recursive:true});
await copyFile(resolve(root,'resources/css/app.css'),resolve(out,'site.css'));
await copyFile(resolve(root,'resources/js/app.js'),resolve(out,'site.js'));
console.log('Assets built: public/assets/site.css, public/assets/site.js, public/assets/premium.js');
await copyFile(resolve(root,'resources/js/premium.js'),resolve(root,'public/assets/premium.js'));
