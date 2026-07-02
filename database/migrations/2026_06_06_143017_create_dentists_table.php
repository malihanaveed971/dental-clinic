public function up(): void
{
    Schema::create('dentists', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('specialization');
        $table->string('phone')->nullable();
        // Add these new fields for a more professional profile
        $table->string('email')->unique(); // Unique email for contact
        $table->text('bio')->nullable();    // Allows for longer professional descriptions
        $table->string('photo_path')->nullable(); // To store the path to their profile image
        $table->timestamps();
    });
}