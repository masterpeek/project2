@extends('app2')

@section('content')

    <main class="mdl-layout__content">
        <div class="mdl-grid portfolio-max-width">
            <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text mdl-typography--headline">เกี่ยวกับ</h2>
                </div>

                <div class="mdl-grid portfolio-copy">
                    <h3 class="mdl-cell mdl-cell--12-col mdl-typography--headline">ที่มาและความสำคัญของปัญหา
                    </h3>
                    <div class="mdl-cell mdl-cell--8-col mdl-card__supporting-text no-padding ">
                        <p>
                            ปัจจุบันปัญหาสิ่งแวดล้อมที่มนุษย์ประสบอยู่ที่สำคัญ ได้แก่ ปัญหาการลดลงของทรัพยากรธรรมชาติ ปัญหาของสารพิษที่มีปริมาณเพิ่มสูงขึ้น และปัญหาของระบบนิเวศที่ถูกทำลาย ซึ่งปัญหาเหล่านี้มาจากปัญหาย่อยหลายปัญหา อาทิเช่น ปัญหาจากมลพิษทางเสียง ปัญหาจากมลพิษทางอากาศ เป็นต้น ปัญหาเหล่านี้ถ้าไม่ได้รับการป้องกันอาจส่งผลกระทบต่อสิ่งมีชีวิตได้ ซึ่งการป้องกันแก้ไขจึงเป็นหน้าที่ของทุกคนที่ต้องช่วยกัน
                            โทรศัพท์เคลื่อนที่เข้ามามีบทบาทต่อชีวิตประจำวันของมนุษย์ ทำให้การติดต่อสื่อสารมีความเจริญก้าวหน้าไปอย่างมาก รวมทั้งมีการพัฒนาแอพพลิเคชันเพื่อตอบสนองความต้องการของมนุษย์อย่างต่อเนื่อง จึงทำให้ความต้องการของโทรศัพท์เคลื่อนที่เพิ่มสูงมากขึ้นตามลำดับ โทรศัพท์เคลื่อนที่จึงกลายเป็นส่วนหนึ่งของชีวิตประจำวัน และเป็นสิ่งจำเป็นขั้นพื้นฐานที่ผู้คนส่วนใหญ่จะให้เวลาอยู่กับโทรศัพท์เคลื่อนที่ในแต่ละวันด้วยการใช้งานแอพพลิเคชันต่างๆ เป็นเวลานาน
                            ข้อมูลเกี่ยวกับมลพิษทางเสียง และอากาศส่วนใหญ่สามารถสืบค้นได้จากเว็บไซต์ของกรมควบคุมมลพิษ ซึ่งจะรายงานข้อมูลในรูปแบบของตัวเลข ซึ่งเป็นตัวเลขของค่าความเข้มเสียง ค่าของปริมาณแก๊สต่างๆ เช่น แก๊สโอโซน แก๊สไนโตรเจนไดออกไซด์ แก๊สคาร์บอนมอนออกไซด์ ก๊าซซัลเฟอร์ไดออกไซด์ เป็นต้น รวมทั้งค่าดัชนีคุณภาพอากาศ ทำให้ผู้ใช้งานเข้าใจได้ยาก จากปัญหาดังกล่าวผู้พัฒนาจึงได้มีความสนใจที่จะพัฒนาแอพพลิเคชันที่ช่วยรวบรวม จัดเก็บ วิเคราะห์ แจ้งเตือน และแนะนำวิธีการปฏิบัติตนที่ถูกต้องเมื่อพบภาวะมลพิษในแต่ละระดับในรูปแบบที่เข้าใจง่าย โดยแอพพลิเคชันนี้จะพัฒนาอยู่บนโทรศัพท์เคลื่อนที่ เนื่องจากเทคโนโลยีของโทรศัพท์เคลื่อนที่ได้รับความนิยมอย่างแพร่หลายเข้าถึงผู้คนได้ง่าย แอพพลิเคชันที่พัฒนาขึ้นนี้จะเป็นอุปกรณ์ช่วยในการตรวจจับสัญญาณโดยใช้โทรศัพท์เคลื่อนที่ (Mobile Sensing) ซึ่งใช้โทรศัพท์เคลื่อนที่เป็นเหมือนอุปกรณ์ตรวจจับคลื่นเสียงและแจ้งเตือนมลพิษทางอากาศเพื่อประมวลผลความเป็นมลพิษ จากนั้นแสดงผลลัพธ์ในรูปแบบที่เข้าใจและใช้งานง่าย เพื่อให้คนทั่วไปสามารถตรวจสอบ และรายงานปัญหามลพิษได้อย่างสะดวกรวดเร็ว

                        </p>
                    </div>

                    <h3 class="mdl-cell mdl-cell--12-col mdl-typography--headline">วัตถุประสงค์
                    </h3>

                    <div class="mdl-cell mdl-cell--8-col mdl-card__supporting-text no-padding ">
                        <p>
                            เพื่อพัฒนาแอพพลิเคชันบนโทรศัพท์เคลื่อนที่ที่สามารถแจ้งเตือนมลพิษทางเสียงและอากาศได้

                        </p>

                        <p>
                            เพื่อสนับสนุนการสร้างเครือข่ายสังคมให้มีส่วนร่วมในการรายงานปัญหามลพิษทางเสียงและอากาศ
                        </p>

                        <p>
                            เพื่อแนะนำวิธีการวางแผน และการปฏิบัติตนที่ถูกต้องเมื่ออยู่ในพื้นที่ที่มีมลพิษ
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @stop