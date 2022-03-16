export class Item {
    constructor(private name:string, private num:number){}

    public say(elem : HTMLElement | null) : void {
        if(elem){ 
            elem.innerHTML = 'こんにちは！ ' + this.name + 'さん' + 'typescriptで簡単な実装！' + 'これも' + this.num + 'つの成果物です！';
        }
    }
}